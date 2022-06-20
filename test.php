<?php
include 'config.php';
spl_autoload_register(function ($className) {
    include "class/" . $className . '.php';
});
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$learn = LearnBox::getLearnboxbyId(17);
//
echo '<pre>';

print_r($_REQUEST);
$allqs = Flashcard::getFlashcardsbySubjects($_REQUEST['subjectarr']);
$keys = array_rand($allqs,$_REQUEST['quantity']);
$question = array();
foreach ($keys as $key){
    $question[] = $allqs[$key];
}
shuffle($question);
print_r($question);
echo '</pre>';
//

//echo $learn->getPerzentig();

//Flashcard::create('was ist 5+3','8','Math');
