<?php

namespace Tnapf\Driver\Interfaces;

use Tnapf\Driver\Exceptions\QueryException;

interface PreparedQueryInterface extends QueryInterface
{
    /**
     * Bind a value to a named parameter in the prepared statement.
     *
     * @param string $name The name of the parameter.
     * @param mixed $value The value to bind to the parameter.
     *
     * @throws QueryException on failure.
     */
    public function bindValue(string $name, mixed $value): void;

    /**
     * Bind an array of values to their corresponding named parameters in the prepared statement.
     *
     * @param array $values An associative array of parameter names and their corresponding values.
     *
     * @throws QueryException on failure.
     */
    public function bindValues(array $values): void;
}
