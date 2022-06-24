<?php

class Actionshowlearnbox implements Actioninterface
{

    public function execute(array $array): array
    {

        return array(
            'learnbox'=> LearnBox::getLearnboxbyId($array['learnboxid'])
        );
    }
}