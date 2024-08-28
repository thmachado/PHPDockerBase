<?php

namespace Root\App\Controllers;

use Root\App\Models\User;
use Root\App\View;

class UsersController
{
    private User $userModel;

    public function __construct(\PDO $pdo)
    {
        $this->userModel = new User($pdo);
    }

    public function index()
    {
        $users = $this->userModel->findAll();

        return (new View('users/index', ["users" => $users, "countUsers" => count($users)]))->render();
    }

    public function create()
    {
        return (new View('users/create', []))->render();
    }

    public function store()
    {
        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_DEFAULT);
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_DEFAULT);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
        $passwordPepper = hash_hmac('sha256', $password, 'crud');
        $passwordHash = password_hash($passwordPepper, PASSWORD_ARGON2ID);

        if ($this->userModel->create($firstname, $lastname, $email, $passwordHash)) {
            return header('Location: /users?success=1');
        }

        return header('Location: /users/create?error=1');
    }
}
