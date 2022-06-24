<?php

class Actionretry implements Actioninterface
{
    public function execute(array $array): array
    {
        $user = User::getUserbyId($_SESSION['userid']);
        $oldlearnbox = LearnBox::getLearnboxbyId($array['learnboxid']);
        $learnbox = LearnBox::create($user->getUserid(), $oldlearnbox->getFlashcards());

        return array(
            'learnbox' => $learnbox,
            'index'=> 0
        );
    }


}