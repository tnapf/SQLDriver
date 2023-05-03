<?php

namespace Tnapf\Driver;

use PDOStatement;
use Tnapf\Driver\Interfaces\RowInterface;

class QueryResponseInterface implements Interfaces\QueryResponseInterface
{
    /**
     * @var RowInterface[]
     */
    protected array $rows = [];

    public function __construct(
        public readonly PDOStatement $stmt,
    ) {
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $row) {
            $this->rows[] = new RowInterface($row);
        }
    }

    public function count(): int
    {
        return $this->stmt->rowCount();
    }

    public function fetchRows(int $fetchType = 0): array
    {
    }

    public function fetchNextRow(int $fetchType = 0): ?RowInterface
    {
        // TODO: Implement fetchNextRow() method.
    }

    public function fetchLastRow(int $fetchType = 0): ?RowInterface
    {
        // TODO: Implement fetchLastRow() method.
    }

    public function fetchFirstRow(int $fetchType = 0): ?RowInterface
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
