<?php


namespace app\src\core\database;


use app\src\core\Application;
use PDO;
use PDOStatement;

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

    public function orWhere($column, $operator, $value)
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
        $this->join[] = implode(' ', $join);
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
     * @param string $sortOrder
     * @return $this
     */
    public function groupBy(array $columns): static
    {
        $groupBy = [
            "GROUP BY",
            $this->parseColumns($columns),
        ];
        $this->groupBy[] = implode(' ', $groupBy);
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
        $orderBy = [
            "ORDER BY",
            $this->parseColumns($columns),
            $sortOrder
        ];
        $this->orderBy[] = implode(' ', $orderBy);
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
     * @param int $rowcount
     * @return $this
     */
    public function limit(int $offset, int $rowcount): static
    {
        $limit = [
            "LIMIT",
            $offset . ",",
            $rowcount
        ];
        $this->limit = $limit;
        return $this;
    }

    private function setLimit()
    {
        return implode(' ', $this->limit);
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

    public function count($table)
    {
        $query = [
            "SELECT",
            "COUNT(*)",
            "FROM",
            $table
        ];

        $this->query = $query;
        return $this;
    }

    /**
     * @param $table
     * @param $column
     * @return mixed
     */
    public function queryCount($table, $column): mixed
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