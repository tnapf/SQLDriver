<?php

namespace Tnapf\Driver\Exceptions;

use Throwable;
use Tnapf\Driver\Interfaces\QueryInterface;

/**
 * Represents an exception thrown by a query.
 *
 * @package Tnapf\Driver\Exceptions
 * @see DriverException
 */
class QueryException extends DriverException
{
    /**
     * A QueryException constructor.
     *
     * @param QueryInterface $query
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        public readonly QueryInterface $query,
        string                         $message = "",
        int                            $code = 0,
        Throwable|null                 $previous = null
    )
    {
        parent::__construct($message, $code, $previous);
    }
}
