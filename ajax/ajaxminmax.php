<?php
include '../config.php';
include '../class/User.php';
include '../class/Db.php';
include '../class/Flashcard.php';
$json = file_get_contents('php://input');
$data = json_decode($json);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//$data = array('Math', 'lorem');


echo json_decode(count(Flashcard::getFlashcardsbySubjects($data)));
//echo count(Flashcard::getFlashcardsbySubjects($data));