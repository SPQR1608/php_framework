<?php


namespace vendor\core\base;

use vendor\core\Db;

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

    public function __construct()
    {
        $this->pdo = Db::instance();
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