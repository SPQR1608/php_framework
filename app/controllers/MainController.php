<?php
namespace app\controllers;

use app\models\Main;
use vendor\core\App;

class MainController extends AppController
{
    //public $layout = 'main';
    public function indexAction()
    {
        //App::$app->getList();
        //$this->layout = false;
        //$this->view = 'test';

        $model = new Main;
        \R::fancyDebug(true);
        //$posts = $model->findAll();
        //$post = $model->findOne(2, 'category_id');
        //$posts = $model->findBySql("SELECT * FROM {$model->table} WHERE title LIKE ?", ['%то%']);
        //$posts = $model->findLike('те', 'title');

        $posts = App::$app->cache->get('posts');
        if (!$posts) {
            $posts = \R::findAll('posts');
            App::$app->cache->set('posts', $posts);
        }

        $menu = $this->menu;

        $this->setMeta('Main Page', 'Description', 'Keywords');
        $meta = $this->meta;
        $this->set(compact('posts', 'menu', 'meta'));
    }
}