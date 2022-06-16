<?php
//include '../class/User.php';
include '../config.php';
include '../class/User.php';
include '../class/Db.php';
$func = $_REQUEST['func'];
$name = $_REQUEST['name'];

if (User::checkIfUserNameExist($name)) {
    echo json_encode(true);
} else {
    echo json_encode(false);
}
//switch ($func) {
//    case ('checkIfUserNameExist'):
////        echo $name;
//
//        break;
//    case ('test'):
//        echo 'test';
//        break;
//}
//echo 'tests';