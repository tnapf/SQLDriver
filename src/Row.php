<?php

namespace Tnapf\Driver;

use Tnapf\Driver\Interfaces\RowInterface;

/**
 * Represents a row of a result.
 *
 * @implements RowInterface
 * @package Tnapf\Driver
 */
class Row implements RowInterface
{
    public function __construct(
        protected readonly array $row
    ) {
    }

    /**
     * Returns the row as an array for json_encode.
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->row;
    }

    /**
     * Returns the columns of the row.
     *
     * @return array<string, mixed>
     */
    public function getColumns(): array
    {
        $array = [];

        foreach ($this->row as $key => $value) {
            $array[$key] = $value;
        }

        return $array;
    }

    /**
     * Returns the value of the column.
     *
     * @param string $columnName
     * @return mixed|null
     */
    public function getColumn(string $columnName): mixed
    {
        return $this->row[$columnName] ?? null;
    }

    /**
     * Returns the column names of the row.
     *
     * @return array<string>
     */
    public function getColumnNames(): array
    {
        return array_keys($this->row);
    }
}
