<?php

class Actiongoto implements Actioninterface
{

    public function execute(array $array): array
    {
        return array(
            'index' => $array['frageindex'],
            'learnbox'=> LearnBox::getLearnboxbyId($array['learnboxid'])
        );
    }
}