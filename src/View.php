<?php

namespace Root\App;

class View
{
    const FILE_PATH = __DIR__ . '/Views/';

    public function __construct(protected string $view, protected array $params = [])
    {
        $file = self::FILE_PATH . $this->view . '.php';
        if (file_exists($file) === false) {
            http_response_code(404);
        }

        include $file;
    }

    public static function make(string $view, array $params): self
    {
        return new self($view, $params);
    }
}
