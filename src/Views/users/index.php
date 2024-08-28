<?php

$alertSuccess = '';
if (filter_input(INPUT_GET, 'success', FILTER_VALIDATE_INT)) {
    $alertSuccess = "<p style='color: green; font-size: bold;'>User created.</p>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
</head>

<body>
    <h1>Users</h1>
    <?= $alertSuccess; ?>
    <p>We have <?= $this->params['countUsers']; ?> users in the system.</p>
    <a href='/users/create'>Create user</a>
</body>

</html>