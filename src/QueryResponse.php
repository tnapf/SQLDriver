<?php

namespace Tnapf\Driver;

use PDOStatement;
use PDO;
use Tnapf\Driver\Interfaces\QueryResponseInterface;
use Tnapf\Driver\Interfaces\RowInterface;

/**
 * Represents a response of a query.
 *
 * @implements QueryResponseInterface
 * @package Tnapf\Driver
 */
class QueryResponse implements QueryResponseInterface
{
    /**
     * @var array<Row>
     */
    protected array $rows = [];

    /**
     * The current position of the iterator.
     *
     * @var int
     */
    protected int $position = 0;

    /**
     * Creates a new QueryResponse.
     *
     * @param PDOStatement $stmt
     */
    public function __construct(
        public readonly PDOStatement $stmt,
    ) {
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $row) {
            $this->rows[] = new Row($row);
        }
    }

    /**
     * Returns the number of rows.
     *
     * @return int
     */
    public function count(): int
    {
        return $this->stmt->rowCount();
    }

    /**
     * Returns the rows.
     *
     * @return array|RowInterface[]|Row[]
     */
    public function fetchRows(): array
    {
        return $this->rows;
    }

    /**
     * Returns the next row.
     *
     * @return RowInterface|null
     */
    public function fetchNextRow(): RowInterface|null
    {
        return $this->rows[$this->position++] ?? null;
    }

    /**
     * Returns the last row of the result.
     *
     * @return RowInterface|null
     */
    public function fetchLastRow(): RowInterface|null
    {
        return $this->rows[count($this) - 1] ?? null;
    }

    /**
     * Returns the first row of the result.
     *
     * @return RowInterface|null
     */
    public function fetchFirstRow(): RowInterface|null
    {
        return $this->rows[0] ?? null;
    }

    /**
     * Returns the number of rows.
     *
     * @return int
     */
    public function getRowCount(): int
    {
        return count($this);
    }

    /**
     * Returns the json serializable rows.
     *
     * @return array|Row[]
     */
    public function jsonSerialize(): array
    {
        return $this->rows;
    }
}
