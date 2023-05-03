<?php

namespace Tnapf\Driver;

use Tnapf\Driver\Interfaces\RowInterface;

class Row implements RowInterface
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
        $array = [];

        foreach ($this->row as $key => $value) {
            $array[$value] = $key;
        }

        return $array;
    }

    public function getColumn(string $columnName): mixed
    {
        // TODO: Implement getColumn() method.
    }

    public function getColumnNames(): array
    {
        return array_keys($this->row);
    }
}
