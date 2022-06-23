<?php

final class FrontController
{

    private string $view;
    private string $action;
    private static $instance = null;
    private array $params;



    public static function getInstance($view = 'login', $action = ""): FrontController
    {
        if (self::$instance === null) {
            self::$instance = new self($view, $action);
        }

        return self::$instance;
    }

    private function __construct(string $view, string $action = null)
    {

        $this->view = $view;
        $this->action = $action;
    }

    public function getParams(){
        return $this->params;
    }


    public function run()
    {
        if (!$this->action == "") {
            $actionobj = new $this->action;
            $this->setParams($actionobj->execute());
        }
//        include 'view/menu.php';
        include 'view/' . $this->view . '.php';



    }

    public function setParams($params)
    {
        $this->params = $params;
        return $this;

    }




}