<?php


namespace spqr\core;


class Registry
{
    use TSingleton;

    /**
     * @var array
     */
    public static $objects = [];

    protected function __construct()
    {
        require_once ROOT . '/config/config.php';
        foreach ($config['components'] as $name => $component) {
            self::$objects[$name] = new $component;
        }
    }

    public function getList()
    {
        echo '<pre>';
        echo var_dump(self::$objects);
        echo '</pre>';
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if (is_object(self::$objects[$name])) {
            return self::$objects[$name];
        }
    }

    /**
     * @param $name
     * @param $object
     */
    public function __set($name, $object)
    {
        if (!isset(self::$objects[$name])) {
            self::$objects[$name] = new $object;
        }
    }
}