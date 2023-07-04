<?php

namespace Tnapf\Driver;

use PDOStatement;
use Tnapf\Driver\Exceptions\QueryException;
use Tnapf\Driver\Interfaces\DriverInterface;
use Tnapf\Driver\Interfaces\PreparedQueryInterface;
use Tnapf\Driver\Interfaces\QueryResponseInterface;

/**
 * Represents a prepared query.
 *
 * @implements PreparedQueryInterface
 * @package Tnapf\Driver
 */
class PreparedQuery implements PreparedQueryInterface
{
    /**
     * The prepared statement.
     *
     * @var PDOStatement $stmt
     */
    protected PDOStatement $stmt;


    /**
     * Creates a new PreparedQuery.
     *
     * @param string $query
     * @param DriverInterface $driver
     */
    public function __construct(
        public readonly string          $query,
        public readonly DriverInterface $driver
    )
    {
        $this->stmt = $this->driver->pdo->prepare($this->query);
    }

    /**
     * Binds a value to the query.
     *
     * @param string $name
     * @param mixed $value
     * @return void
     * @throws QueryException
     */
    public function bindValue(string $name, mixed $value): void
    {
        $result = $this->stmt->bindValue($name, $value);

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
     * Binds multiple values to the query.
     *
     * @param array $values
     * @return void
     * @throws QueryException
     */
    public function bindValues(array $values): void
    {
        foreach ($values as $name => $value) {
            $this->bindValue($name, $value);
        }
    }

    /**
     * Executes the query and returns the response.
     *
     * @return QueryResponseInterface
     * @throws QueryException
     */
    public function execute(): QueryResponseInterface
    {
        $result = $this->stmt->execute();

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
