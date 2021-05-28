<?php


namespace app\src;


use PDO;
use PDOStatement;

class QueryBuilder
{
    protected PDO $connection;

    protected array $query = [];
    protected array $where = [];
    protected array $join = [];

    public function __construct()
    {
        $this->connection = Application::$app->db->pdo;
    }

    /**
     * @return $this
     */
    public function select(array $columns, string $table): static
    {
        $query = [
            "SELECT",
            $this->parseColumns($columns),
            "FROM",
            $table
        ];

        $this->query = $query;
        return $this;
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
            $operator
        ];

        if (is_numeric($value)) {
            $whereClause[] = $value;
        } else {
            $whereClause[] = "'" . $value . "'";
        }

        $this->where[] = implode(' ', $whereClause);
        return $this;
    }

    /**
     * @return string
     */
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
     * @param string $table
     * @param array $values
     * @return $this
     */
    public function insert(string $table, array $values): static
    {
        $query = [
            "INSERT INTO",
            $table,
            $this->insertInColumns($values),
            "VALUES",
            $this->createQueryParams($values)
        ];

        $this->query = $query;
        return $this;
    }

    /**
     * @param string $table
     * @param array $values
     * @return QueryBuilder
     */
    public function update(string $table, array $values = []): static
    {
        $query = [
            "UPDATE",
            $table,
            "SET",
            $this->setParams($values),
        ];

        $this->query = $query;
        return $this;
    }

    public function delete(string $table): static
    {
        $query = [
            "DELETE FROM",
            $table,
        ];
        $this->query = $query;
        return $this;
    }

    /**
     * @param string $table
     * @param array $values
     * @return $this
     */
    public function join(string $table, array $values): static
    {
        $join = [
            "INNER JOIN",
            $table,
            "ON",
            $this->onColumns($values)
        ];
        $this->join = $join;
        return $this;
    }

    public function onColumns(array $columns): string
    {
        $stmt = [];
        foreach ($columns as $key => $value) {
            $stmt[] = $key . ' = ' . $value;
        }
        return implode(', ', array_values($stmt));
    }

    private function setJoinColumns(array $joins)
    {
        return implode(' ', $joins);
    }

    /**
     * Return an string of columns separated with a comma
     * @param array $columns
     * @return string
     */
    private function parseColumns(array $columns): string
    {
        return implode(', ', array_values($columns));
    }

    /**
     * @param array $columns
     * @return string
     */
    private function insertInColumns(array $columns): string
    {
        return "(" . implode(', ', array_keys($columns)) . ")";
    }

    /**
     * @param array $values
     * @return string
     */
    private function createQueryParams(array $values): string
    {
        return "(:" . implode(', :', array_keys($values)) . ")";
    }

    /**
     * Specify params after SET in query.
     * @param array $values
     * @return string
     */
    private function setParams(array $values): string
    {
        $stmt = [];
        foreach ($values as $key => $value) {
            $stmt[] = $key . ' = :' . $key;
        }
        return implode(', ', array_values($stmt));
    }


    /**
     * @return string
     */
    private function getQueryAsString(): string
    {
        if (!empty($this->join)) {
            $this->query = array_merge($this->query, $this->join);
        }

        if (!empty($this->where)) {
            $this->query[] = $this->setWhereClause();
        }

        return implode(' ', $this->query);
    }

    /**
     * @param array $values
     * @return PDOStatement|bool
     */
    public function query(array $values = []): PDOStatement|bool
    {
        if (!empty($values)) {
            $stmt = $this->connection->prepare($this->getQueryAsString());
            $stmt->execute($values);
        } else {
            $stmt = $this->connection->query($this->getQueryAsString());
        }

        return $stmt;
    }







}