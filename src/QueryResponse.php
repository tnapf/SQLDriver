<?php

namespace Tnapf\Driver;

use PDOStatement;
use PDO;
use Tnapf\Driver\Interfaces\QueryResponseInterface;

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

    public function fetchNextRow(): ?Row
    {
        return $this->rows[$this->position++] ?? null;
    }

    public function fetchLastRow(): ?Row
    {
        return $this->rows[count($this) - 1] ?? null;
    }

    public function fetchFirstRow(): ?Row
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
