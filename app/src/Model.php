<?php

namespace app\src;


use PDO;
use PDOStatement;
use ReflectionClass;

abstract class Model
{
    protected PDO $connection;
    protected array $fillableColumns = [];

    protected array $where = [];

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

    /**
     * @param array $values
     */
    public function update(array $values = []): void
    {
        $sql = [
            "UPDATE",
            $this->getTable(),
            "SET",
            $this->setParams($values),
        ];

        if (!empty($this->where)) {
            $sql[] = $this->setWhereClause();
        }

        $this->query($this->buildQueryStatement($sql), $values);
    }


    /**
     * Delete the model specified in where clause.
     * If no where clause exists do not execute, instead use deleteAll() method.
     */
    public function delete(): void
    {
        if (!empty($this->where)) {
            $sql = [
                "DELETE FROM",
                $this->getTable(),
            ];
            $sql[] = $this->setWhereClause();

            $this->query($this->buildQueryStatement($sql));
        }
    }

    /**
     * Deletes all records from the table.
     */
    public function deleteAll(): void
    {
        $sql = [
            "DELETE FROM",
            $this->getTable(),
        ];

        $this->query($this->buildQueryStatement($sql));
    }


    /**
     * Specify params after SET in query.
     * @param array $values
     * @return string
     */
    private function setParams(array $values): string
    {
        $columns = implode(', ', array_keys($values));
        $bindParams = "=:" . implode(', ', array_keys($values));
        return $columns . $bindParams;
    }


    /**
     * Allows adding multiple where clauses by method chaining.
     * @param $column
     * @param $operator
     * @param $value
     * @return $this
     */
    public function where($column, $operator, $value): static
    {
        $whereClause = [
            $column,
            $operator,
            $value
        ];
        $this->where[] = implode(' ', $whereClause);
        return $this;
    }

    private function setWhereClause(): string
    {
        $whereClause[] = "WHERE";

        $separator = ' ';
        if (count($this->where) > 1) {
            $separator = ' AND ';
        }

        $whereClause[] = implode($separator, $this->where);
        return implode(' ', $whereClause);
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


    /**
     * @param string $column
     * @return mixed
     */
    public function get(string $column): mixed
    {
        $stmt = "SELECT " . $column . " FROM " . $this->getClassName();
        return $this->query($stmt)->fetchColumn();
    }

    public function getAll(): array
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

    // Set Model name to lower string to represent table name
    public function getTable(): string
    {
        return strtolower($this->getClassName());
    }


}