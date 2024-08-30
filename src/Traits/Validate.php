<?php

namespace Root\App\Traits;

trait Validate
{
    private function validateString(int $inputType, string $content, int $filter)
    {
        return htmlspecialchars(trim(filter_input($inputType, $content, $filter)));
    }
}