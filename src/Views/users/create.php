<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users - Form</title>
</head>

<body>
    <h1>Users</h1>
    <form method="POST" action="/users/store">
        <input type="text" name="firstname" placeholder="Firstname" required />
        <input type="text" name="lastname" placeholder="Lastname" required />
        <input type="email" name="email" placeholder="Email" required />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">Create</button>
    </form>
</body>

</html>