<?php


namespace vendor\core\base;


abstract class Controller
{
    /**
     * @var array
     */
    public $route = [];

    /**
     * @var string
     */
    public $view;

    /**
     * @var string
     */
    public $layout;

    /**
     * @var array
     */
    public $vars = [];

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = $route['action'];
    }

    public function getView()
    {
        $vObj = new View($this->route, $this->layout, $this->view);
        $vObj->render($this->vars);
    }

    public function set($vars)
    {
        $this->vars = $vars;
    }
}