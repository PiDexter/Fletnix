<?php

namespace app\src;


use PDO;
use PDOStatement;
use ReflectionClass;

abstract class Model
{
    protected PDO $connection;
    protected array $attributes = [];

    protected array $fillableColumns = [];

    protected string $where;

    public function __construct()
    {
        $this->connection = Application::$app->db->pdo;
    }

    /**
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }

    /**
     * Create new row in the db table that is equal to the model
     * @param array $values
     */
    public function create(array $values = []): void
    {
        $sql = [
            "INSERT INTO",
            $this->getTable(),
            $this->columns($values),
            "VALUES",
            $this->createQueryParams($values)
        ];

        $this->query($this->buildQueryStatement($sql), $values);
    }

    public function update(array $values = [])
    {
        $sql = [
            "UPDATE",
            $this->getTable(),
            "SET",
            $this->setParams($values),
            "WHERE",
            $this->where
        ];

        $this->query($this->buildQueryStatement($sql), $values);
    }

    public function setParams(array $values): string
    {
        $columns = implode(', ', array_keys($values));
        $bindParams = "=:" . implode(', ', array_keys($values));
        return $columns . $bindParams;
    }

    public function where($column, $operator, $value): static
    {
        $where = [
            $column,
            $operator,
            $value
        ];
        $this->where = implode(' ', $where);
        return $this;
    }

    /**
     * @param array $columns
     * @return string
     */
    public function columns(array $columns): string
    {
        return "(" . implode(', ', array_keys($columns)) . ")";
    }

    /**
     * @param array $values
     * @return string
     */
    public function createQueryParams(array $values): string
    {
        return "(:" . implode(', :', array_keys($values)) . ")";
    }


    /**
     * @param array $queryData
     * @return string
     */
    public function buildQueryStatement(array $queryData): string
    {
        return implode(' ', $queryData);
    }

    /**
     * @param string $query
     * @param array $values
     * @return bool|PDOStatement
     */
    public function query(string $query, array $values = []): bool|PDOStatement
    {
        if (!empty($values)) {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($values);
        } else {
            $stmt = $this->connection->query($query);
        }
        return $stmt;
    }





    public function get(string $column)
    {
        $stmt = "SELECT " . $column . " FROM " . $this->getClassName();
        return $this->query($stmt)->fetchColumn();
    }

    public function getAll()
    {
        $stmt = "SELECT * FROM " . $this->getClassName();
        return $this->query($stmt)->fetchAll();
    }

    /**
     * Get class name of
     * @return string
     */
    public function getClassName(): string
    {
        return (new ReflectionClass($this))->getShortName();
    }

    // Set Model name to lower string, represents table name
    public function getTable(): string
    {
        // TODO Database tables to lowercase and then use below
        // $table = strtolower($this->getClassName() . "s");
        return $this->getClassName() . "s";
    }


}