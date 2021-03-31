<?php


namespace app\controllers;


use app\models\User;
use spqr\core\base\View;

class UserController extends AppController
{
    public function signupAction()
    {
        if(!empty($_POST)) {
            $user = new User();
            $data = $_POST;
            $user->load($data);
            if (!$user->validate($data) || !$user->checkUnique()) {
                $user->getErrors();
                $_SESSION['form_data'] = $data;
                redirect();
            }
            $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
            if ($user->save('user')) {
                $_SESSION['success'] = 'Registered successfully';
            } else {
                $_SESSION['error'] = 'Error.';
            }
            redirect();
        }
        View::setMeta('SignUp');
    }

    public function loginAction()
    {
        if(!empty($_POST)) {
            $user = new User();
            if ($user->login()) {
                $_SESSION['success'] = 'Authorization successfully';
            } else {
                $_SESSION['error'] = 'Login/Password are invalid';
                $_SESSION['form_data'] = $_POST;
            }
            redirect('/admin/');
        }
        View::setMeta('Log In');
    }

    public function logoutAction()
    {
        if (isset($_SESSION['USER'])) unset($_SESSION['USER']);
        redirect('/user/login/');
    }
}