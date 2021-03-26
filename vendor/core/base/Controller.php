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

    public function isAjax()
    {
        // NOT WORK WITH FETCH
        //return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
        return isset($_POST['fetch']) && $_POST['fetch'] === 'y';
    }

    public function loadView($view, $vars = [])
    {
        extract($vars);
        require APP . "/views/{$this->route['controller']}/{$view}.php";
    }
}