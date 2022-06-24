<?php

class Actiondelete implements Actioninterface
{

    public function execute(array $array):array
    {
        LearnBox::deletebyId($array['learnboxid']);
        return array();
    }
}