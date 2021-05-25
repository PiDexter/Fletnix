<?php


namespace app\src;


use PDO;
use PDOStatement;

class QueryBuilder
{
    protected PDO $connection;

    protected array $query = [];
    protected array $where = [];

    public function __construct()
    {
        $this->connection = Application::$app->db->pdo;
    }

    /**
     * @return $this
     */
    public function select(string $table, array $columns): static
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

        var_dump($table);
        var_dump($values);
        $query = [
            "UPDATE",
            $table,
            "SET",
            $this->setParams($values),
        ];

        $this->query = $query;
        var_dump($this->query);
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
        $query = [
            "INNER JOIN",
            $table,
            "ON",
            $this->parseColumns($values)
        ];
        $this->query = $query;
        return $this;
    }

    /**
     * Return an string of columns separated with a comma
     * @param array $columns
     * @return string
     */
    public function parseColumns(array $columns): string
    {
        return implode(', ', array_values($columns));
    }

    /**
     * @param array $columns
     * @return string
     */
    public function insertInColumns(array $columns): string
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
     * @return string
     */
    public function getQueryAsString(): string
    {
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

        var_dump($this->getQueryAsString());
        var_dump($values);
        if (!empty($values)) {
            $stmt = $this->connection->prepare($this->getQueryAsString());
            $stmt->execute($values);
        } else {
            $stmt = $this->connection->query($this->getQueryAsString());
        }
        return $stmt;
    }







}