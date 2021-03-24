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

    public function __construct($route)
    {
        $this->route = $route;
    }
}