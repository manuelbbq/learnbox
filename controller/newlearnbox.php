<?php

class newlearnbox implements Actioninterface
{

    public function execute($array):array
    {
        $user = User::getUserbyId($_SESSION['userid']);

        $allqs = Flashcard::getFlashcardsbySubjects($array['subjectarr']);
        $keys = array_rand($allqs, $array['quantity']);
        $question = array();
        foreach ($keys as $key) {
            $question[] = $allqs[$key];
        }
        shuffle($question);
        $learnbox = LearnBox::create($user->getUserid(), $question);
        return array(
            'index' => 0,
            'learnbox' => $learnbox,

        );
    }
}