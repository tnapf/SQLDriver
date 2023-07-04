<?php

namespace Tnapf\Driver\Interfaces;

use Countable;
use JsonSerializable;

/**
 * Represents a response of a query.
 *
 * @package Tnapf\Driver\Interfaces
 * @extends Countable
 * @extends JsonSerializable
 */
interface QueryResponseInterface extends Countable, JsonSerializable
{
    /**
     * Fetch all rows in the result set.
     *
     * @return RowInterface[] An array of RowInterface objects representing the fetched rows.
     */
    public function fetchRows(): array;

    /**
     * Fetch the next row in the result set.
     *
     * @return RowInterface|null A RowInterface object representing the next row, or null if there are no more rows.
     */
    public function fetchNextRow(): ?RowInterface;

    /**
     * Fetch the last row in the result set.
     *
     * @return RowInterface|null A RowInterface object representing the last row, or null if the result set is empty.
     */
    public function fetchLastRow(): ?RowInterface;

    /**
     * Fetch the first row in the result set.
     *
     * @return RowInterface|null A RowInterface object representing the first row, or null if the result set is empty.
     */
    public function fetchFirstRow(): ?RowInterface;

    /**
     * Get the number of rows in the result set.
     *
     * @return int The number of rows in the result set.
     */
    public function getRowCount(): int;
}
