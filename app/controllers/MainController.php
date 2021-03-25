<?php
namespace app\controllers;

use app\models\Main;

class MainController extends AppController
{
    //public $layout = 'main';
    public function indexAction()
    {
        //$this->layout = false;
        //$this->view = 'test';

        $model = new Main;

        //$posts = $model->findAll();
        //$post = $model->findOne(2, 'category_id');
        //$posts = $model->findBySql("SELECT * FROM {$model->table} WHERE title LIKE ?", ['%то%']);
        //$posts = $model->findLike('те', 'title');

        $posts = \R::findAll('posts');
        $menu = $this->menu;

        $this->setMeta('Main Page', 'Description', 'Keywords');
        $meta = $this->meta;
        $this->set(compact('posts', 'menu', 'meta'));
    }
}