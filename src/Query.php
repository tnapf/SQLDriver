<?php

namespace Tnapf\Driver;

use Tnapf\Driver\Exceptions\QueryException;
use Tnapf\Driver\Interfaces\DriverInterface;
use Tnapf\Driver\Interfaces\QueryInterface;
use Tnapf\Driver\Interfaces\QueryResponseInterface;

/**
 * Represents a query.
 *
 * @implements QueryInterface
 * @package Tnapf\Driver
 */
class Query implements QueryInterface
{
    /**
     * Creates a new Query.
     *
     * @param string $query
     * @param DriverInterface $driver
     */
    public function __construct(
        public readonly string          $query,
        public readonly DriverInterface $driver
    )
    {
    }

    /**
     * Executes the query and returns the response.
     *
     * @return QueryResponseInterface
     * @throws QueryException
     */
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
