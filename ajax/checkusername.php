<?php
include '../config.php';
include '../class/User.php';
include '../class/Db.php';
$func = $_REQUEST['func'] ?? 0;
$name = $_REQUEST['name'] ?? 0;
$pw = $_REQUEST['password'] ?? 0;

if (User::checkIfUserNameExist($name)) {
    echo json_encode(true);
} else {
    echo json_encode(false);
}


