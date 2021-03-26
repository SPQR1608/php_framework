<?php


namespace vendor\core\base;


class View
{
    /**
     * @var array
     */
    public $route = [];

    /**
     * @var string
     */
    public $view;

    /**
     * @var string
     */
    public $layout;

    /**
     * @var array
     */
    public $scripts = [];

    /**
     * @var string[]
     */
    public static $meta = ['title' => '', 'desc' => '', 'keywords' => ''];

    public function __construct($route, $layout, $view)
    {
        $this->route = $route;
        if ($layout === false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ? : LAYOUT;
        }

        $this->view = $view;
    }

    /**
     * Render Layout
     */
    public function render($vars) {
        if (is_array($vars)) extract($vars);
        $file_view = APP . "/views/{$this->route['controller']}/{$this->view}.php";
        ob_start();
        if (is_file($file_view)) {
            require $file_view;
        } else {
            echo "<p>View $file_view not found</p>";
        }
        $content = ob_get_clean();

        if (false !== $this->layout) {
            $file_layout = APP . "/views/layouts/{$this->layout}.php";
            if (is_file($file_layout)) {
                $content = $this->getScript($content);
                $scripts = [];
                if (!empty($this->scripts[0])) {
                    $scripts = $this->scripts[0];
                }
                require $file_layout;
            } else {
                echo "<p>Layout $file_layout not found</p>";
            }
        }
    }

    protected function getScript($content)
    {
        $pattern = "#<script.*?>.*?</script>#si";
        preg_match_all($pattern, $content, $this->scripts);
        if (!empty($this->scripts)) {
            $content = preg_replace($pattern, '', $content);
        }
        return $content;
    }

    public static function getMeta()
    {
        echo '<title>' . self::$meta['title'] . '</title>
             <meta name="description" content="' . self::$meta['desc'] . '">
             <meta name="keywords" content="' . self::$meta['keywords'] . '">';
    }

    public static function setMeta($title = '', $desc = '', $keywords = '')
    {
        self::$meta['title'] = $title;
        self::$meta['desc'] = $desc;
        self::$meta['keywords'] = $keywords;
    }
}