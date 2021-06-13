<?php


namespace app\src\core\database;


use app\src\core\Application;
use PDO;
use PDOStatement;

/**
 * Class QueryBuilder
 * @package app\src\core\database
 */
class QueryBuilder
{
    protected PDO $connection;

    private array $query = [];
    private array $where = [];
    private array $join = [];
    private array $orderBy = [];
    private array $groupBy = [];
    private array $limit = [];

    private bool $distinct = false;

    public function __construct()
    {
        $this->connection = Application::$app->db->pdo;
    }

    /**
     * @return $this
     */
    public function select(array $columns, string $table): static
    {
        $query[] = "SELECT";

        if ($this->distinct) {
            $query[] = "DISTINCT";
        }

        $query[] = $this->parseColumns($columns);
        $query[] = "FROM";
        $query[] = $table;

        $this->query = $query;
        return $this;
    }

    /**
     * @return $this
     */
    public function distinct(): static
    {
        $this->distinct = true;
        return $this;
    }

    /**
     * Allows adding multiple where clauses by method chaining.
     * @param string $column
     * @param string $operator
     * @param string|int $value
     * @return $this
     */
    public function where(string $column, string $operator, string|int $value): static
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
     * @param string $column
     * @param string $operator
     * @param string|int $value
     * @return $this
     */
    public function orWhere(string $column, string $operator, string|int $value): static
    {
        $whereClause = [
            "OR",
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
        if (count($this->where) > 1) {

            // Loop through all where elements
            foreach ($this->where as $index => $value) {

                // If index is larger than zero and does not start with "OR", append "AND" before element
                if ($index > 0 && !str_starts_with($value, 'OR')) {
                    $this->where[$index] = 'AND ' . $value;
                }
            }
        }
        $whereClause[] = implode(' ', $this->where);
        return implode(' ', $whereClause);
    }


    /**
     * @param string $table
     * @param array $values
     * @return $this
     */
    public function insert(string $table, array $values): static
    {
        $stmt = [
            "INSERT INTO",
            $table,
            $this->insertInColumns($values),
            "VALUES",
            $this->createQueryParams($values)
        ];

        $this->query = $stmt;
        return $this;
    }

    /**
     * @param string $table
     * @param array $values
     * @return QueryBuilder
     */
    public function update(string $table, array $values = []): static
    {
        $stmt = [
            "UPDATE",
            $table,
            "SET",
            $this->setParams($values),
        ];

        $this->query = $stmt;
        return $this;
    }

    /**
     * @param string $table
     * @return $this
     */
    public function delete(string $table): static
    {
        $stmt = [
            "DELETE FROM",
            $table,
        ];
        $this->query = $stmt;
        return $this;
    }

    /**
     * @param string $table
     * @param array $values
     * @return $this
     */
    public function join(string $table, array $values): static
    {
        $stmt = [
            "INNER JOIN",
            $table,
            "ON",
            $this->onColumns($values)
        ];
        $this->join[] = implode(' ', $stmt);
        return $this;
    }

    /**
     * @param array $columns
     * @return string
     */
    public function onColumns(array $columns): string
    {
        $stmt = [];
        foreach ($columns as $key => $value) {
            $stmt[] = $key . ' = ' . $value;
        }
        return implode(', ', array_values($stmt));
    }

    /**
     * @return string
     */
    private function setJoins(): string
    {
        $joinClause[] = implode(' ', $this->join);
        return implode(' ', $joinClause);
    }

    /**
     * @param array $columns
     * @return $this
     */
    public function groupBy(array $columns): static
    {
        $stmt = [
            "GROUP BY",
            $this->parseColumns($columns),
        ];
        $this->groupBy[] = implode(' ', $stmt);
        return $this;
    }

    /**
     * @return string
     */
    private function setGroupBy(): string
    {
        $groupByClause[] = implode(' ', $this->groupBy);
        return implode(' ', $groupByClause);
    }

    /**
     * @param array $columns
     * @param string $sortOrder
     * @return $this
     */
    public function orderBy(array $columns, string $sortOrder): static
    {
        $stmt = [
            "ORDER BY",
            $this->parseColumns($columns),
            $sortOrder
        ];
        $this->orderBy[] = implode(' ', $stmt);
        return $this;
    }

    /**
     * @return string
     */
    private function setOrderBy(): string
    {
        $orderByClause[] = implode(' ', $this->orderBy);
        return implode(' ', $orderByClause);
    }

    /**
     * @param int $offset
     * @param int $rowCount
     * @return $this
     */
    public function limit(int $offset, int $rowCount): static
    {
        $stmt = [
            "LIMIT",
            $offset . ",",
            $rowCount
        ];
        $this->limit = $stmt;
        return $this;
    }

    private function setLimit(): string
    {
        return implode(' ', $this->limit);
    }

    /**
     * Return a string of columns separated with a comma
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
            $this->query[] = $this->setJoins();
        }

        if (!empty($this->where)) {
            $this->query[] = $this->setWhereClause();
        }

        if (!empty($this->groupBy)) {
            $this->query[] = $this->setGroupBy();
        }

        if (!empty($this->orderBy)) {
            $this->query[] = $this->setOrderBy();
        }

        if (!empty($this->limit)) {
            $this->query[] = $this->setLimit();
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

    /**
     * @param string $table
     * @return $this
     */
    public function count(string $table): static
    {
        $stmt = [
            "SELECT",
            "COUNT(*)",
            "FROM",
            $table
        ];

        $this->query = $stmt;
        return $this;
    }

    /**
     * @param string $table
     * @param string $column
     * @return mixed
     */
    public function queryCount(string $table, string $column): mixed
    {
        // Replace DISTINCT with COUNT(DISTINCT and replace next index (containing columns) with specific table column
        if (($key = array_search('DISTINCT', $this->query, true)) !== false) {
            $this->query[$key] = "COUNT(DISTINCT";
            $this->query[$key + 1] = $table . "." . $column . ")";
        }

        // Find all query strings with LIMIT and remove those
        array_filter($this->query, function($key) {
            if (str_starts_with($this->query[$key], 'LIMIT')) {
                unset($this->query[$key]);
            }
        }, ARRAY_FILTER_USE_KEY);

        $stmt = implode(' ', $this->query);
        return $this->connection->query($stmt)->fetchColumn();
    }

    public function getQuery(): array
    {
        return $this->query;
    }

}