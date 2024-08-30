<?php

namespace Root\App\Traits;

trait Flash
{
    private function flashMessage(string $message)
    {
        $_SESSION['flash_message'] = $message;
    }
}
