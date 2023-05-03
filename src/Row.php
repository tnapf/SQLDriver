<?php

namespace Tnapf\Driver;

class Row implements Interfaces\RowInterface
{
    public function __construct(
        protected readonly array $row
    ) {
    }

    public function jsonSerialize(): array
    {
        return $this->row;
    }

    public function getColumns(): array
    {
        return array_keys($this->row);
    }

    public function getColumn(string $columnName): mixed
    {
        // TODO: Implement getColumn() method.
    }

    public function getRaw(): array
    {
        // TODO: Implement getRaw() method.
    }
}
