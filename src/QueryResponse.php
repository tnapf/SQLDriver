<?php

namespace Tnapf\Driver;

use ArrayIterator;
use PDOStatement;
use PDO;
use Tnapf\Driver\Interfaces\QueryResponseInterface;
use Tnapf\Driver\Interfaces\RowInterface;
use Traversable;

class QueryResponse implements QueryResponseInterface
{
    /**
     * @var Row[]
     */
    protected array $rows;
    protected int $position = 0;

    public function __construct(public readonly PDOStatement $stmt)
    {
    }

    private function load(): array
    {
        return $this->rows ??= array_map(
            Row::create(...),
            $this->stmt->fetchAll(PDO::FETCH_ASSOC)
        );
    }

    public function count(): int
    {
        return $this->getRowCount();
    }

    public function getRowCount(): int
    {
        return $this->stmt->rowCount();
    }

    public function fetchRows(): array
    {
        return $this->load();
    }

    public function fetchNextRow(): ?RowInterface
    {
        $rows = $this->load();

        return $rows[$this->position++] ?? null;
    }

    public function fetchLastRow(): ?RowInterface
    {
        $rows = $this->load();

        return $rows[$this->getRowCount() - 1] ?? null;
    }

    public function fetchFirstRow(): ?RowInterface
    {
        $rows = $this->load();

        return $rows[0] ?? null;
    }

    public function jsonSerialize(): array
    {
        return $this->load();
    }
}
