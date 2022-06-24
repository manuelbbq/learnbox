<?php

class Actionwelcome implements Actioninterface
{

    public function execute($array): array
    {
        if (isset($array['newuser'])) {
            $name = $array['newname'];
            $pw = $array['newpassword'];
            $user = User::create($name, $pw);
        } else {
            $userid = $array['userid'] ?? $_SESSION['userid'];
            $user = User::getUserbyId($userid);
        }
        $_SESSION['userid'] = $user->getUserid();
        return array('user' => $user);

    }

}