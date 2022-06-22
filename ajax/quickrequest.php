<?php
include '../config.php';
include '../class/Flashcard.php';
include '../class/Db.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$json = file_get_contents('php://input');
$data = json_decode($json);

$subjectarr = array($data);
//$subjectarr = array('html');
$flashcards = Flashcard::getFlashcardsbySubjects($subjectarr);
$flashcard = $flashcards[rand(0,count($flashcards)-1)];

//echo json_encode(false);
//echo json_encode('test');
echo json_encode([$flashcard->getQuestion(),$flashcard->getAnswer()]);