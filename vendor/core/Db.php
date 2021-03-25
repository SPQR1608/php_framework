<?php


namespace vendor\core;


class Db
{
    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * @var Db
     */
    protected static $instance;

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

        /*$options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];
        $this->pdo = new \PDO($db['dsn'], $db['user'], $db['pass'], $options);*/

    }

    /**
     * @return Db
     */
    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /*
    public function execute($sql, $params = [])
    {
        self::$countSql++;
        self::$queries[] = $sql;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public function query($sql, $params = [])
    {
        self::$countSql++;
        self::$queries[] = $sql;
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute($params);
        if ($res !== false) {
            return $stmt->fetchAll();
        }

        return [];
    }*/
}