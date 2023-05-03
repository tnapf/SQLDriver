<?php

namespace Tnapf\Driver;

use Tnapf\Driver\Exceptions\QueryException;
use Tnapf\Driver\Interfaces\DriverInterface;
use Tnapf\Driver\Interfaces\QueryInterface;
use Tnapf\Driver\Interfaces\QueryResponseInterface;

class Query implements QueryInterface
{
    public function __construct(
        public readonly string $query,
        public readonly DriverInterface $driver
    ) {
    }

    public function execute(): QueryResponseInterface
    {
        $result = $this->driver->pdo->query($this->query);

        if ($result === false) {
            [$sqlState, $errorCode, $errorMessage] = $this->driver->pdo->errorInfo();
            throw new QueryException(
                $this,
                sprintf("Query failed with error %s: %s", $sqlState, $errorMessage),
                $errorCode
            );
        }

        return new QueryResponse($result);
    }
}
