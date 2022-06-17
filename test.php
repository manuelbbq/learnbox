<?php
include 'config.php';
spl_autoload_register(function ($className) {
    include "class/" . $className . '.php';
});
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//$learn = LearnBox::getLearnboxbyId(6);
//
//echo '<pre>';
//print_r($learn->getFlashcards());
//echo '</pre>';
//
//echo $learn->getPerzentig();

//Flashcard::create('was ist 5+3','8','Math');
