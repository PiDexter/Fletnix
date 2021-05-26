<?php

namespace app\src;


use PDO;
use ReflectionClass;

abstract class Model
{
    protected QueryBuilder $builder;
    protected PDO $connection;

    protected array $fillableColumns = [];
    protected string $primaryKey = 'id';


    public function __construct()
    {
        $this->builder = Application::$app->builder;
        $this->connection = Application::$app->db->pdo;
    }


    /**
     * Create new row in the db table that is equal to the model
     * @param array $values
     */
    public function create(array $values = []): void
    {
        $this->builder
            ->insert($this->getTable(), $values)
            ->query($values);
    }


    /**
     * @param int $id
     * @param array $values
     */
    public function update(int $id, array $values = []): void
    {
        $this->builder
            ->update($this->getTable(), $values)
            ->where($this->getPrimaryKey(), '=', $id)
            ->query($values);
    }


    /**
     * Delete the model specified in where clause.
     * If no where clause exists do not execute, instead use deleteAll() method.
     */
    public function delete(int $id): void
    {
        $this->builder
            ->delete($this->getTable())
            ->where($this->getPrimaryKey(), '=', $id)
            ->query();
    }


    /**
     * @param int $id
     * @return mixed
     */
    public function findByID(int $id): mixed
    {
        return $this->builder
            ->where($this->getPrimaryKey(), '=', $id)
            ->select((array)'*', $this->getTable())
            ->query()->fetch();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findByString(string $value): mixed
    {
        return $this->builder
            ->where($this->getPrimaryKey(), '=', $value)
            ->select((array)'*', $this->getTable())
            ->query()->fetch();
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->builder
            ->select((array)'*', $this->getTable())
            ->query()->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array
     */
    public function allWith(string $table, array $joinColumns): array
    {
        return $this->builder
            ->select(['*'], $this->getTable())
            ->join($table, $joinColumns)
            ->query()->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * @return string
     */
    public function getPrimaryKey(): string
    {
        return $this->getTable() . "_" . $this->primaryKey;
    }

    /**
     * @param string $primaryKey
     */
    public function setPrimaryKey(string $primaryKey): void
    {
        $this->primaryKey = $primaryKey;
    }


    /**
     * Get class name of
     * @return string
     */
    public function getClassName(): string
    {
        return (new ReflectionClass($this))->getShortName();
    }

    // Set Model name to lower string to represent table name
    public function getTable(): string
    {
        return strtolower($this->getClassName());
    }


}