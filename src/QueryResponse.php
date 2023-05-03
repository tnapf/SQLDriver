<?php

namespace Tnapf\Driver;

use Tnapf\Driver\Interfaces\Row;
use PDOStatement;

class QueryResponse implements Interfaces\QueryResponse
{
    /**
     * @var Row[]
     */
    protected array $rows = [];
    public function __construct(
        public readonly PDOStatement $stmt,
    ) {
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $row) {
            $this->rows[] = new Row($row);
        }
    }

    public function count(): int
    {
        return $this->stmt->rowCount();
    }

    public function fetchRows(int $fetchType = 0): array
    {

    }

    public function fetchNextRow(int $fetchType = 0): ?Row
    {
        // TODO: Implement fetchNextRow() method.
    }

    public function fetchLastRow(int $fetchType = 0): ?Row
    {
        // TODO: Implement fetchLastRow() method.
    }

    public function fetchFirstRow(int $fetchType = 0): ?Row
    {
        // TODO: Implement fetchFirstRow() method.
    }

    public function getRowCount(): int
    {
        return count($this);
    }

    public function jsonSerialize(): mixed
    {
        // TODO: Implement jsonSerialize() method.
    }
}