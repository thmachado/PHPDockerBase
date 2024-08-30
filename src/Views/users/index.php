<?php

if (isset($_SESSION['flash_message'])) {
    $message = htmlspecialchars($_SESSION['flash_message']);
    echo "<div>{$message}</div>";
    unset($_SESSION['flash_message']);
}

$tableHTML = "<tr><td colspan='4'>Don't have users in the system</td></tr>";
$users = $this->params['users'];
if ($users) {
    $tableHTML = '';
    foreach ($users as $user) {
        $tableHTML .= "<tr>
            <td>{$user->firstname} {$user->lastname}</td>
            <td>{$user->email}</td>
            <td>User</td>
            <td>
                <a href='/users/edit?id={$user->id}'>Edit</a>
                <a href='/users/delete?id={$user->id}'>Delete</a>
            </td>
        </tr>
        ";
    }
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
</head>

<body>
    <h1>Users</h1>
    <a href='/users/create'>Create user</a>
    <p>We have <?= count($users); ?> users in the system.</p>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?= $tableHTML; ?>
        </tbody>
    </table>
</body>

</html>