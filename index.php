<?php
include 'config.php';
spl_autoload_register(function ($className) {
    include "class/" . $className . '.php';
});
session_start();
$action = $_REQUEST['action'] ?? 'login';
//$id = $_REQUEST['id'] ?? null;
$userinput = $_REQUEST['userinput'] ?? '';
$frageindex = $_REQUEST['frageindex'] ?? 0;
$loginerror = '';

//User::create('Mia','miau');
//$user = User::getUserbyId(2);
//$user->changePassbyId('456');
//$learnbox = $_REQUEST['learnbox'] ?? new LearnBox(Flashcard::getall());
//
//echo '<pre>';
//print_r($_REQUEST);
//echo 'session <br>';
//print_r($_SESSION);
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
    case ('login'):
        session_unset();
        $view = 'login';
        break;
    case ('showfirst'):
        $name = $_REQUEST['name'];
        $password = $_REQUEST['password'];
        $user = User::getUserbyName($name);
        if ($user->checkpw($password)) {
            $_SESSION['learnbox'] = new LearnBox(Flashcard::getall());
            $_SESSION['userid'] = $user->getUserid();
            $_SESSION['name'] = $user->getName();
            $view = 'card';
        } else {
            $loginerror = 'Login Fehler';
            $view = 'login';
        }
        break;
    case ('answer'):
        $view = 'card';
        $learnbox = $_SESSION['learnbox'];
        $learnbox->getFlashcards()[$frageindex - 1]->setUserInput($userinput);
        $_SESSION['learnbox'] = $learnbox;
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
    case ('retry'):
        $_SESSION['learnbox'] = new LearnBox(Flashcard::getall());
        $view = 'card';
        break;
    case ('newuser'):
        $view = 'welcome';
        $name = $_REQUEST['newname'];
        $pw = $_REQUEST['newpassword'];
        $user = User::create($name,$pw);
        $_SESSION['userid'] = $user->getUserid();
        $_SESSION['name'] = $user->getName();
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

//echo '<pre>';
//print_r($_REQUEST);
//echo 'session <br>';
//print_r($_SESSION);
//echo '</pre>';
