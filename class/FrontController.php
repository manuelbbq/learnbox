<?php

final class FrontController
{

    private string $view;
    private string $action;
    private static $instance = null;
    private array $params;


    public static function getInstance($view, $action, $params): FrontController
    {
        if (self::$instance === null) {
            self::$instance = new self($view, $action, $params);
        }

        return self::$instance;
    }

    private function __construct(string $view, string $action = null, array $params)
    {

        $this->view = $view;
        $this->action = $action;
        $this->params = $params;
    }

    public function getParams()
    {
        return $this->params;
    }


    public function run()
    {
        if (!$this->action == "") {
            $actionobj = new $this->action;
            $this->setParams($actionobj->execute($this->params));
        }
        if ($this->view != 'login') {
            include 'view/menu.php';
        }
        include 'view/' . $this->view . '.php';


    }

    public function setParams($params)
    {
        $this->params = $params;
        return $this;

    }


}