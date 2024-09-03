<?php

namespace Root\App\Controllers;

use Root\App\Models\User;
use Root\App\Traits\Response;
use Root\App\Traits\Validate;
use Root\App\View;

class UsersController
{
    use Response;
    use Validate;

    private User $userModel;

    public function __construct(\PDO $pdo)
    {
        $this->userModel = new User($pdo);
    }

    public function index()
    {
        return View::make('users/index', ["users" => $this->userModel->findAll()]);
    }

    public function create()
    {
        return View::make('users/create', []);
    }

    public function edit()
    {
        $user = $this->userModel->find($this->validateUser());
        if ($user === false) {
            return $this->response("/users", 404, "User not found");
        }

        return View::make('users/edit', ["user" => $user]);
    }

    public function delete()
    {
        $userid = $this->validateUser();
        if ($this->userModel->find($userid) === false) {
            return $this->response("/users", 404, "User not found");
        }

        if ($this->userModel->delete($userid) === false) {
            return $this->response("/users", 404, "You can't delete it");
        }

        return $this->response("/users", 200, "User deleted");
    }

    public function store()
    {
        $firstname = $this->validateData(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
        $lastname = $this->validateData(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = $this->validateData(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = $this->validateData(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
        $passwordPepper = hash_hmac('sha256', $password, 'crud');
        $passwordHash = password_hash($passwordPepper, PASSWORD_ARGON2ID);

        if ($this->userModel->validate($email) === false) {
            return $this->response("/users", 404, "You need to use another email");
        }

        if ($this->userModel->create($firstname, $lastname, $email, $passwordHash) === false) {
            return $this->response("/users", 404, "You can't create it");
        }

        return $this->response("/users", 200);
    }

    public function update()
    {
        $userid = filter_input(INPUT_POST, 'userid', FILTER_VALIDATE_INT);
        $firstname = $this->validateData(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
        $lastname = $this->validateData(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);

        if ($this->userModel->update($userid, $firstname, $lastname) === false) {
            return $this->response("/users", 404, "You can't update it");
        }

        return $this->response("/users", 200, "User updated");
    }

    private function validateUser()
    {
        $userid = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($userid === null) {
            return $this->response("/users", 404, "ID parameter is required");
        }

        return $userid;
    }
}
