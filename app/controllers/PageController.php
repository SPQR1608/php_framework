<?php


namespace app\controllers;


class PageController extends AppController
{
    public function viewAction()
    {
        $menu = $this->menu;
        $title = 'Page';
        $this->set(compact('title', 'menu'));
    }
}