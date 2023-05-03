<?php

namespace Tnapf\Driver\Interfaces;

use Stringable;

interface RowInterface extends Stringable
{
    /**
     * Get all columns in the row as an associative array.
     *
     * @return array An associative array of column names and their corresponding values.
     */
    public function getColumns(): array;

    /**
     * Get the value of a specific column in the row.
     *
     * @param string $columnName The name of the column to get the value of.
     * @return mixed The value of the specified column.
     */
    public function getColumn(string $columnName): mixed;

    /**
     * Get an array of column names in the row.
     *
     * @return array An array of column names.
     */
    public function getColumnNames(): array;

    /**
     * Convert the row to an associative array.
     *
     * @return array An associative array of column names and their corresponding values.
     */
    public function toArray(): array;
}
