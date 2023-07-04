<?php

namespace Tnapf\Driver;

use Exception;
use PDOException;
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

    /**
     * @throws QueryException
     */
    public function execute(): QueryResponseInterface
    {
        try {
            $result = $this->driver->pdo->query($this->query);
        } catch (PDOException $e) {
            throw new QueryException($this, $e->getMessage(), $e->getCode(), $e);
        }

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
