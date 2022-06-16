<?php
//include '../class/User.php';
include '../config.php';
include '../class/User.php';
include '../class/Db.php';
$func = $_REQUEST['func'];
$name = $_REQUEST['name'];
$pw = $_REQUEST['password'];
switch ($func){
    case('checkIfUserNameExist'):
        if (User::checkIfUserNameExist($name)) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    case ('login'):
        $user = User::getUserbyName($name);
        if ($user->checkpw($pw)){
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }

}