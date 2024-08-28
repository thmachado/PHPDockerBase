<?php

namespace Root\App;

class View
{
    const FILE_PATH = __DIR__ . '/Views/';

    public function __construct(protected string $view, protected array $params = []) {}

    public function render()
    {
        $file = self::FILE_PATH . $this->view . '.php';
        if (file_exists($file) === null) {
            http_response_code(404);
        }

        include $file;
    }
}
