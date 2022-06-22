<?php
include '../config.php';
include '../class/User.php';
include '../class/Db.php';
$name = $_REQUEST['name'] ?? 0;
$pw = $_REQUEST['password'] ?? 0;

$user = User::getUserbyName($name);
if (!$user) {
    echo json_encode(false);
} else {
    if ($user->checkpw($pw)) {
        $arr = [true, $user->getUserid()];
        echo json_encode($arr);
    } else {
        echo json_encode(false);
    }
}