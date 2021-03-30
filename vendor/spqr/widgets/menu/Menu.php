<?php


namespace spqr\widgets\menu;


use spqr\libs\Cache;

class Menu
{
    protected $data;
    protected $tree;
    protected $menuHtml;
    protected $tpl = 'menu';
    protected $container = 'ul';
    protected $class = 'menu';
    protected $table = 'categories';
    protected $cache = 3600;
    protected $cachKey;

    public function __construct($options = [])
    {
        $this->getOptions($options);
        $this->cachKey = $this->tpl . '_cache';
        $this->run();
    }

    protected function getOptions($options)
    {
        foreach ($options as $k => $v) {
            if (property_exists($this, $k)) {
                $this->$k = $v;
            }
        }
    }

    protected function output()
    {
        echo "<{$this->container} class=\"{$this->class}\">{$this->menuHtml}</{$this->container}>";
    }

    protected function run()
    {
        if ($this->cache) {
            $cache = new Cache();
            $this->menuHtml = $cache->get($this->cachKey);

            if (!$this->menuHtml) {
                $this->getData();
                $cache->set($this->cachKey, $this->menuHtml, $this->cache);
            }
        } else {
            $this->getData();
        }

        $this->output();
    }

    protected function getData()
    {
        $this->data = \R::getAssoc("SELECT * FROM {$this->table}");
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);
    }

    protected function getTree()
    {
        $tree = [];
        $dataset = $this->data;
        foreach ($dataset as $id=>&$node) {
            if (!$node['parent']) {
                $tree[$id] = &$node;
            } else {
                $dataset[$node['parent']]['childs'][$id] = &$node;
            }
        }

        return $tree;
    }

    protected function getMenuHtml($tree, $tab = '')
    {
        $html = '';
        foreach ($tree as $id => $cat) {
            $html .= $this->catToTemplate($cat, $tab, $id);
        }
        return $html;
    }

    protected function catToTemplate($category, $tab, $id)
    {
        ob_start();
        require __DIR__ . '/menu_tpl/' . $this->tpl .'.php';
        return ob_get_clean();
    }
}