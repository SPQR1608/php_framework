<?php
namespace app\controllers;

class MainController extends AppController
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