<?php

class Actionshowfirst implements Actioninterface
{

    public function execute()
    {
        $user = User::getUserbyId($_SESSION['userid']);

        $allqs = Flashcard::getFlashcardsbySubjects($_REQUEST['subjectarr']);
        $keys = array_rand($allqs, $_REQUEST['quantity']);
        $question = array();
        foreach ($keys as $key) {
            $question[] = $allqs[$key];
        }
        shuffle($question);
        $learnbox = LearnBox::create($user->getUserid(), $question);
        $_SESSION['learnboxid'] = $learnbox->getLearnboxId();
        $_SESSION['index'] = 0;
    }
}