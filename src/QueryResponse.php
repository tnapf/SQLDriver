<?php

namespace Tnapf\Driver;

use PDOStatement;
use PDO;
use Tnapf\Driver\Interfaces\QueryResponseInterface;
use Tnapf\Driver\Interfaces\RowInterface;

class QueryResponse implements QueryResponseInterface
{
    /**
     * @var Row[]
     */
    protected array $rows = [];
    protected int $position = 0;

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

    public function fetchRows(): array
    {
        return $this->rows;
    }

    public function fetchNextRow(): ?RowInterface
    {
        return $this->rows[$this->position++] ?? null;
    }

    public function fetchLastRow(): ?RowInterface
    {
        return $this->rows[count($this) - 1] ?? null;
    }

    public function fetchFirstRow(): ?RowInterface
    {
        return $this->rows[0] ?? null;
    }

    public function getRowCount(): int
    {
        return count($this);
    }

    public function jsonSerialize(): mixed
    {
        return $this->rows;
    }
}
