<?php


namespace spqr\core\base;

use spqr\core\Db;
use Valitron\Validator;

abstract class Model
{
    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * @var string
     */
    protected $table;

    /**
     * Primary key
     * @var string
     */
    protected $pk = 'id';

    /**
     * @var array
     */
    public $attributes = [];

    /**
     * @var array
     */
    public $errors = [];

    /**
     * @var array
     */
    public $rules = [];


    public function __construct()
    {
        $this->pdo = Db::instance();
    }

    /**
     * @param $data
     */
    public function load($data)
    {
        foreach ($this->attributes as $name => $value) {
            if (isset($data[$name])) {
                $this->attributes[$name] = $data[$name];
            }
        }
    }

    /**
     * @param array $data
     * @return bool
     */
    public function validate($data) {
        $v = new Validator($data);
        $v->rules($this->rules);
        if ($v->validate()) {
            return true;
        }
        $this->errors = $v->errors();
        return false;
    }

    /**
     * @param $sql
     * @return bool
     */
    public function query($sql)
    {
        return $this->pdo->execute($sql);
    }

    /**
     * @return array|false|\PDOStatement
     */
    public function findAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->pdo->query($sql);
    }

    /**
     * @param $id
     * @param string $field
     * @return array|false|\PDOStatement
     */
    public function findOne($id, $field = '')
    {
        $field = $field ? : $this->pk;
        $sql = "SELECT * FROM {$this->table} WHERE {$field} = ? LIMIT 1";
        return $this->pdo->query($sql, [$id]);
    }

    /**
     * @param string $sql
     * @param array $params
     * @return array|false|\PDOStatement
     */
    public function findBySql($sql, $params = [])
    {
        return $this->pdo->query($sql, $params);
    }

    /**
     * @param string $str
     * @param string $field
     * @param string $table
     * @return array|false|\PDOStatement
     */
    public function findLike($str, $field, $table = '')
    {
        $table = $table ? : $this->table;
        $sql = "SELECT * FROM {$table} WHERE {$field} LIKE ?";
        return $this->pdo->query($sql, ["%{$str}%"]);
    }
}