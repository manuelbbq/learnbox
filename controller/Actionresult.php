<?php

class Actionresult implements Actioninterface
{

    public function execute(array $array): array
    {
        return array(
            'learnbox' => LearnBox::getLearnboxbyId($array['learnboxid'])

        );
    }
}