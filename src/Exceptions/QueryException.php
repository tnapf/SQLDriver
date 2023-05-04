<?php

namespace Tnapf\Driver\Exceptions;

use Throwable;
use Tnapf\Driver\Interfaces\QueryInterface;

class QueryException extends DriverException
{
    public function __construct(
        public readonly QueryInterface $query,
        string $message = "",
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    public function getQuery(): QueryInterface
    {
        return $this->query;
    }
}
