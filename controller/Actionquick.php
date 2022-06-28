<?php

class Actionquick implements Actioninterface
{

    public function execute(array $array):array
    {

        return array(
            'quick'=> $array['quick']
        );
    }
}