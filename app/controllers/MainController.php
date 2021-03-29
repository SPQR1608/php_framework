<?php
namespace app\controllers;

use app\models\Main;
use vendor\core\App;
use vendor\core\base\View;

class MainController extends AppController
{
    public function indexAction()
    {
        $model = new Main;
        //\R::fancyDebug(true);

        $posts = App::$app->cache->get($model->table);
        if (!$posts) {
            $posts = \R::findAll($model->table);
            App::$app->cache->set($model->table, $posts);
        }

        $menu = $this->menu;

        View::setMeta('Main Page', 'Description', 'Keywords');
        $this->set(compact('posts', 'menu'));
    }

    public function ajaxAction()
    {
        if ($this->isAjax()) {
            $model = new Main;
            $post = \R::findOne('posts', "id = {$_POST['id']}");
            $this->loadView('ajax', compact('post'));
            die();
        }
    }
}