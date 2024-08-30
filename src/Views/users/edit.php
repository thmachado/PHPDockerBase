<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users - Edit form</title>
</head>

<body>
    <h1>Users</h1>
    <form method="POST" action="/users/update">
        <input type="hidden" name="userid" value="<?php echo $this->params['user']->id; ?>" required />
        <input type="text" name="firstname" placeholder="Firstname"
            value="<?php echo $this->params['user']->firstname; ?>" required />
        <input type="text" name="lastname" placeholder="Lastname" value="<?php echo $this->params['user']->lastname; ?>"
            required />
        <button type="submit">Update</button>
    </form>
</body>

</html>