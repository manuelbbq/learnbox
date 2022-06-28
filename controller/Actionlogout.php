<?php

class Actionlogout implements Actioninterface
{

    public function execute(array $array):array
    {
        session_unset();

        session_destroy();

        return [];
    }
}