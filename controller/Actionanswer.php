<?php

class Actionanswer implements Actioninterface
{

    public function execute(array $array): array
    {
        $frageindex = $array['frageindex'];
        $learnbox = LearnBox::getLearnboxbyId($array['learnboxid']);
        $frageid = $learnbox->getFlashcards()[$frageindex - 1]->getId();
        $learnbox->setUserInput($array['userinput'], $frageid);
        if ($frageindex > count($learnbox->getFlashcards()) - 1) {
            $frageindex--;

        }
        return array(
            'index' => $frageindex,
            'learnbox'=>$learnbox,
        );
    }
}