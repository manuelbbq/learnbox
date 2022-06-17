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
        $action = 'welcome';
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
        $user = User::getUserbyName($name);
        $learnbox = LearnBox::create($user->getUserid(),Flashcard::getall());
        $view = 'card';
        $_SESSION['learnboxid']=$learnbox->getLearnboxId();
        $_SESSION['index'] = 0;

        break;
    case ('answer'):
        $view = 'card';
        $frageindex = $_REQUEST['frageindex'] ?? $_SESSION['index'];
        $_SESSION['index'] = $frageindex;
        $learnbox = LearnBox::getLearnboxbyId($_SESSION['learnboxid']);
        $frageid = $learnbox->getFlashcards()[$frageindex - 1]->getId();
        $learnbox->setUserInput($_REQUEST['userinput'],$frageid);

        if ($frageindex > count($learnbox->getFlashcards()) - 1) {
            $view = 'result';
        }
        break;
    case ('goto'):
        $_SESSION['index'] = $_REQUEST['frageindex'];
        $view = 'card';
        break;
    case ('result'):
        $learnbox = LearnBox::getLearnboxbyId($_SESSION['learnboxid']);
        $view = 'result';
        break;
    case ('retry'):
        $_SESSION['index'] = $_REQUEST['frageindex'] ?? 0;
        $view = 'card';
        break;
    case ('welcome'):
        $view = 'welcome';
        if (isset($_REQUEST['newuser'])) {
            $name = $_REQUEST['newname'];
            $pw = $_REQUEST['newpassword'];
            $user = User::create($name, $pw);
        } else{
            $userid = $_REQUEST['userid'] ?? $_SESSION['userid'];

            $user = User::getUserbyId($userid);
        }
        $_SESSION['userid']= $user->getUserid();
        break;
    case('logout'):
        session_destroy();
        $view = 'login';
        break;
    case('showlearnbox'):
        $view = 'result';
        $learnbox = LearnBox::getLearnboxbyId($_REQUEST['learnboxid']);
        break;

}
if ($view!=='login'){
    include 'view/menu.php';

}
include 'view/' . $view . '.php';


//echo '<pre>';
//print_r($_REQUEST);
//echo 'session <br>';
//print_r($_SESSION);
//echo '</pre>';
