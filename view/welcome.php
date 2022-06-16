<?php
$id = $_SESSION['userid'] ?? 'test';
$name =$_SESSION['name'] ?? 5;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hallo</title>
</head>
<body>
<div>
    Hallo <?php echo $name ?> du bist neu Deine Id ist <?php echo $id ?>.
</div>
</body>
</html>

