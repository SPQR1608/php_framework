<?php


namespace app\controllers\admin;


use spqr\core\base\View;

class UserController extends AppController
{
    public function indexAction()
    {
        View::setMeta('Admin panel :: Main', 'Description', 'Keywords');
    }

    public function testAction()
    {
    }
}