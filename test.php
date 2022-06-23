
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'config.php';
echo '<pre>';
print_r($_REQUEST);
//echo'<br> action = '.$action.'<br>';
echo 'session <br>';
print_r($_SESSION);
echo '</pre>';

spl_autoload_register(function ($className) {
    include "class/" . $className . '.php';
});
$action= $_REQUEST['action'] ?? '';
$view= $_REQUEST['view'] ?? 'login';



$front = FrontController::getInstance($view, $action);
$front->run();
