<?php

class Actionwelcome implements Actioninterface
{

    public function execute():array
    {
        if (isset($_REQUEST['newuser'])) {
            $name = $_REQUEST['newname'];
            $pw = $_REQUEST['newpassword'];
            $user = User::create($name, $pw);
        } else {
            $userid = $_REQUEST['userid'] ?? $_SESSION['userid'];

            $user = User::getUserbyId($userid);
        }
        $_SESSION['userid'] = $user->getUserid();
        return array('user'=>$user);
    }
}