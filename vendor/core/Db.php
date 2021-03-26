<?php


namespace vendor\core;


class Db
{
    use TSingleton;

    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * @var int
     */
    public static $countSql = 0;

    /**
     * @var array
     */
    public static $queries = [];

    protected function __construct()
    {
        require LIBS . '/RedBeanPHP5_6_2/rb.php';
        $db = require ROOT . '/config/config_db.php';
        \R::setup($db['dsn'], $db['user'], $db['pass']);
        \R::freeze(TRUE);
        //\R::fancyDebug(TRUE);
    }
}