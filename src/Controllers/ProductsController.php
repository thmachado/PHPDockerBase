<?php

namespace Root\App\Controllers;

use Root\App\Models\Product;
use Root\App\Traits\Response;
use Root\App\Traits\Validate;

class ProductsController
{
    use Response;
    use Validate;

    private Product $productModel;

    public function __construct(\PDO $pdo)
    {
        $this->productModel = new Product($pdo);
        $this->redis = new \Redis();
        $this->redis->connect('redis', 6379);
    }

    public function index()
    {
        if ($this->redis->get('products')) {
            return $this->responseJson(["products" => json_decode($this->redis->get('products'))], 200);
        }

        $products = $this->productModel->findAll();
        $this->redis->setex('products', 3600, json_encode($products));
        return $this->responseJson(["products" => $products], 200);
    }

    public function store()
    {
        $data = json_decode(file_get_contents("php://input", true));
        if ($data === null) {
            return $this->responseJson(["error" => "You need to insert a object with name, description, category, quantity and price"], 403);
        }

        $name = $this->validateInput($data->name, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $description = $this->validateInput($data->description, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
        $category = $this->validateInput($data->category, 'category', FILTER_SANITIZE_SPECIAL_CHARS);
        $quantity = $this->validateInput($data->quantity, 'quantity', FILTER_VALIDATE_INT);
        $price = $this->validateInput($data->price, 'price', FILTER_VALIDATE_INT);

        if ($this->productModel->create($name, $description, $category, $quantity, $price) === false) {
            return $this->responseJson(["error" => "You can't create it"], 404);
        }

        $this->redis->del('products');
        return $this->responseJson(["product" => "User created."], 201);
    }
}
