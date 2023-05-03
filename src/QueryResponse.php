<?php

namespace Tnapf\Driver;

use PDOStatement;
use Tnapf\Driver\Interfaces\RowInterface;

class QueryResponse implements Interfaces\QueryResponseInterface
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
            $this->rows[] = new RowInterface($row);
        }
    }

    public function count(): int
    {
        return $this->stmt->rowCount();
    }

    public function fetchRows(): array
    {
    }

    public function fetchNextRow(): ?RowInterface
    {
        // TODO: Implement fetchNextRow() method.
    }

    public function fetchLastRow(): ?RowInterface
    {
        // TODO: Implement fetchLastRow() method.
    }

    public function fetchFirstRow(): ?RowInterface
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
