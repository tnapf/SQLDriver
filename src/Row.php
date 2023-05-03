<?php

namespace Tnapf\Driver;

class Row implements Interfaces\Row
{
    protected array $columns = [];
    protected array $values = [];

    public function __construct(
        protected readonly array $row
    ) {
    }

    public function __toString(): string
    {
        // TODO: Implement __toString() method.
    }

    public function getColumns(): array
    {
        // TODO: Implement getColumns() method.
    }

    public function getColumnNames(): array
    {
        return
    }

    public function getColumn(string $columnName): mixed
    {
        // TODO: Implement getColumn() method.
    }

    public function toArray(): array
    {
        // TODO: Implement toArray() method.
    }
}
