<?php


namespace spqr\core;

use spqr\core\Registry;
use spqr\core\ErrorHandler;

class App
{
    public static $app;

    public function __construct()
    {
        session_start();
        self::$app = Registry::instance();
        new ErrorHandler();
    }
}