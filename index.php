<?php

include 'config.php';
spl_autoload_register(function ($className) {
    include "class/" . $className . '.php';
});#
session_start();
$action = $_REQUEST['action'] ?? 'showfirst';
//$id = $_REQUEST['id'] ?? null;
$userinput = $_REQUEST['userinput'] ?? '';
$frageindex = $_REQUEST['frageindex'] ?? 0;



//$learnbox = $_REQUEST['learnbox'] ?? new LearnBox(Flashcard::getall());

//echo '<pre>';
//print_r($_REQUEST);
//echo '</pre>';
//echo '<pre>';
//print_r($learnbox->getFlashcards()[0]);
//
//$test = serialize($learnbox);
//echo 'json <br>';
//echo $test;
//echo 'decode <br>';
//
//$test = unserialize($test);
//print_r($test);
//
//echo '</pre>';

switch ($action) {
    case ('showfirst'):
        $_SESSION['learnbox'] = new LearnBox(Flashcard::getall());

        $view = 'card';
        break;
    case ('answer'):
        $view = 'card';
        $learnbox = $_SESSION['learnbox'];
        $learnbox->getFlashcards()[$frageindex-1]->setUserInput($userinput);
        $_SESSION['learnbox']= $learnbox;
        if ($frageindex > count($learnbox->getFlashcards()) - 1) {
            $view = 'result';
        }
        break;
    case ('goto'):
        $view = 'card';
        break;
    case ('result'):
        $learnbox = $_SESSION['learnbox'];
        $view = 'result';
        break;


}

include 'view/' . $view . '.php';









//
//
//
//Flashcard::create('Geht das qmenu','ja');
////Flashcard::create('fragew2','2');
////Flashcard::create('fragew3','3');
////Flashcard::create('fragew4','4');
////Flashcard::create('fragew5','5');
//
//$learnbox = new LearnBox(Flashcard::getall());
//echo '<pre>';
//print_r($learnbox);
//echo '</pre>';
////
//foreach ($learnbox->getFlashcards() as $flashcard){
//    echo $flashcard->getQuestion();
//}
//
//echo Flashcard::getbyID(1)->getQuestion();
//$flah =  Flashcard::getbyID(1);
//$flah->setUserInput('hallo');
//$flah->setAnswer('hallo');
//$flah->update();
//echo '<br>';
//echo $flah->isUserInputCorrect();


