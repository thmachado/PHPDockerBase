<?php

namespace Root\App\Traits;

trait Validate
{
    use Response;

    private function validateData(int $inputType, string $content, $filter)
    {
        $data = htmlspecialchars(trim(filter_input($inputType, $content, $filter)));
        if (strlen($data) === 0 || $data === false || $data === null) {
            return $this->response("/users", 404, "{$content} not valid.");
        }

        return $data;
    }
}
