<?php

namespace Root\App\Traits;

trait Response
{
    use Flash;
    
    private function response(string $location, int $code, ?string $message = null)
    {
        if ($message) {
            $this->flashMessage($message);
        }
        http_response_code($code);
        header("Location: {$location}");
        exit;
    }
}