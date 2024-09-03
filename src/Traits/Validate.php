<?php

namespace Root\App\Traits;

trait Validate
{
    use Response;

    private function validateData(int $inputType, string $content, int $filter)
    {
        $data = htmlspecialchars(trim(filter_input($inputType, $content, $filter)));
        if (strlen($data) === 0 || $data === false || $data === null) {
            return $this->response("/users", 404, "{$content} not valid.");
        }

        return $data;
    }

    private function validateInput($content, string $param, int $filter)
    {
        $input = htmlspecialchars(filter_var($content, $filter));
        if ($input === null || strlen($input) === 0) {
            return $this->responseJson(["error" => "{$param} is required."], 403);
        }

        return $input;
    }
}
