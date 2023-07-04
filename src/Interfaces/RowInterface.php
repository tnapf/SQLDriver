<?php

namespace Tnapf\Driver\Interfaces;

use JsonSerializable;

/**
 * Represents a row in a result set.
 *
 * @package Tnapf\Driver\Interfaces
 * @extends JsonSerializable
 */
interface RowInterface extends JsonSerializable
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
     * Convert the class to a JSON serializable object.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed;
}
