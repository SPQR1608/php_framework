<?php
namespace vendor\core;

class Router
{
    /**
     * @var array
     */
    protected static $routes = [];

    /**
     * @var array
     */
    protected static $route = [];

    /**
     * @param string $regexp
     * @param array $route
     */
    public static function add(string $regexp, array $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    /**
     * @return array
     */
    public static function getRoutes() : array
    {
        return self::$routes;
    }

    /**
     * @return array
     */
    public static function getRoute() : array
    {
        return self::$route;
    }

    /**
     * @param string $url
     * @return bool
     */
    protected static function matchRoute(string $url) : bool
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#$pattern#i", $url, $matches)) {
                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                if (!isset($route['action'])) {
                    $route['action'] = 'index';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    /**
     * @param string $url
     */
    public static function dispatch(string $url)
    {
        if (self::matchRoute($url)) {
            $controller = 'app\\controllers\\' . self::$route['controller'];
            if (class_exists($controller)) {
                $cObj = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action']) . 'Action';
                if (method_exists($cObj, $action)) {
                    $cObj->$action();
                } else {
                    echo "Метод <b>$controller::$action</b> не найден";
                }
            } else {
                echo "Контроллер <b>$controller</b> не найден";
            }
        } else {
            http_response_code(404);
            include '404.html';
        }
    }

    /**
     * @param string $name
     * @return string
     */
    protected static function upperCamelCase(string $name) : string
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    /**
     * @param string $name
     * @return string
     */
    protected static function lowerCamelCase(string $name) : string
    {
        return lcfirst(self::upperCamelCase($name));
    }
}