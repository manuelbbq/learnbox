<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" required><br>
    <label for="password">Passwort</label>
    <input type="password" id="password" name="password" required><br>
    <button name="action" value="showfirst">Login</button>
<div><?php echo $loginerror ?></div>


</form>

</body>
</html>

<?php
