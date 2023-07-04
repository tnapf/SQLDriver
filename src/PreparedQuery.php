<?php

namespace Tnapf\Driver;

use Exception;
use PDOException;
use PDOStatement;
use Tnapf\Driver\Exceptions\QueryException;
use Tnapf\Driver\Interfaces\DriverInterface;
use Tnapf\Driver\Interfaces\PreparedQueryInterface;
use Tnapf\Driver\Interfaces\QueryResponseInterface;

class PreparedQuery implements PreparedQueryInterface
{
    protected PDOStatement $stmt;

    public function __construct(
        public readonly string $query,
        public readonly DriverInterface $driver
    ) {
        $this->stmt = $this->driver->pdo->prepare($this->query);
    }

    /**
     * @throws QueryException
     */
    public function bindValue(string $name, mixed $value): void
    {
        try {
            $result = $this->stmt->bindValue($name, $value);
        } catch (PDOException $e) {
            throw new QueryException($this, $e->getMessage(), $e->getCode(), $e);
        }

        if ($result === false) {
            [$sqlState, $errorCode, $errorMessage] = $this->stmt->errorInfo();
            throw new QueryException(
                $this,
                sprintf("Failed to bind value to query. Error %s: %s", $sqlState, $errorMessage),
                $errorCode
            );
        }
    }

    /**
     * @throws QueryException
     */
    public function bindValues(array $values): void
    {
        foreach ($values as $name => $value) {
            $this->bindValue($name, $value);
        }
    }

    /**
     * @throws QueryException
     */
    public function execute(): QueryResponseInterface
    {
        try {
            $result = $this->stmt->execute();
        } catch (PDOException $e) {
            throw new QueryException($this, $e->getMessage(), $e->getCode(), $e);
        }

        if ($result === false) {
            [$sqlState, $errorCode, $errorMessage] = $this->stmt->errorInfo();
            throw new QueryException(
                $this,
                sprintf("Query failed with error %s: %s", $sqlState, $errorMessage),
                $errorCode
            );
        }

        return new QueryResponse($this->stmt);
    }
}
