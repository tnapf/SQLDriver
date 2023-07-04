<?php

namespace Tnapf\Driver\Interfaces;

/**
 * Represents a prepared query.
 *
 * @package Tnapf\Driver\Interfaces
 * @extends QueryInterface
 */
interface PreparedQueryInterface extends QueryInterface
{
    /**
     * Bind a value to a named parameter in the prepared statement.
     *
     * @param string $name The name of the parameter.
     * @param mixed $value The value to bind to the parameter.
     */
    public function bindValue(string $name, mixed $value): void;

    /**
     * Bind an array of values to their corresponding named parameters in the prepared statement.
     *
     * @param array $values An associative array of parameter names and their corresponding values.
     */
    public function bindValues(array $values): void;
}
