<?php
namespace app\controllers;

class Main extends App
{
    //public $layout = 'main';
    public function indexAction()
    {
        //$this->layout = false;
        //$this->view = 'test';

        $name = 'VARS';
        $color = [
            '1' => 'red',
            '2' => 'blue',
        ];
        $this->set(compact('name', 'color'));
    }
}