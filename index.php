<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include 'config.php';
spl_autoload_register(function ($className) {
    include "class/" . $className . '.php';
});
session_start();

if (isset($_REQUEST['action'])) {
    $action = $_REQUEST['action'];
} else {
    if (isset($_SESSION['userid'])) {
        $action = 'retry';
    } else {
        $action = 'login';
    }
}

$userinput = $_REQUEST['userinput'] ?? '';

//echo '<pre>';
//print_r($_REQUEST);
//echo'<br> action = '.$action.'<br>';
//echo 'session <br>';
//print_r($_SESSION);
//echo '</pre>';



switch ($action) {
    case ('login'):
        $view = 'login';
        break;
    case ('showfirst'):
        $name = $_REQUEST['name'];
//        $password = $_REQUEST['password'];
        $user = User::getUserbyName($name);
        $view = 'card';
        $_SESSION['learnbox'] = new LearnBox(Flashcard::getall());
        $_SESSION['userid'] = $user->getUserid();
        $_SESSION['name'] = $user->getName();
        $_SESSION['index'] = 0;

        break;
    case ('answer'):
        $view = 'card';
        $frageindex = $_REQUEST['frageindex'] ?? $_SESSION['index'];
        $_SESSION['index'] = $frageindex;
        $learnbox = $_SESSION['learnbox'];
        $frageid = $learnbox->getFlashcards()[$frageindex - 1]->getId();
        echo $frageid,$_SESSION['userid'],$_REQUEST['userinput'];
        Userinput::create($frageid,$_SESSION['userid'],$_REQUEST['userinput']);
        $_SESSION['learnbox'] = $learnbox;
        if ($frageindex > count($learnbox->getFlashcards()) - 1) {
            $view = 'result';
        }
        break;
    case ('goto'):
        $_SESSION['index'] = $_REQUEST['frageindex'];
        $view = 'card';
        break;
    case ('result'):
        $learnbox = $_SESSION['learnbox'];
        $view = 'result';
        break;
    case ('retry'):
        $_SESSION['index'] = $_REQUEST['frageindex'] ?? 0;
        $_SESSION['learnbox'] = new LearnBox(Flashcard::getall());
        $view = 'card';
        break;
    case ('newuser'):
        $view = 'welcome';
        $name = $_REQUEST['newname'];
        $pw = $_REQUEST['newpassword'];
        $user = User::create($name, $pw);
        $_SESSION['userid'] = $user->getUserid();
        $_SESSION['name'] = $user->getName();
        break;
    case('logout'):
        session_destroy();
        $view = 'login';
        break;
}
include 'view/menu.php';
include 'view/' . $view . '.php';


//echo '<pre>';
//print_r($_REQUEST);
//echo 'session <br>';
//print_r($_SESSION);
//echo '</pre>';
