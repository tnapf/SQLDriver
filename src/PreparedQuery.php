<?php

namespace Tnapf\Driver;

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

    public function bindValue(string $name, mixed $value): void
    {
        $result = $this->stmt->bindValue($name, $value);

        if ($result === false) {
            throw new \Exception("Failed to bind value to query");
        }
    }

    public function bindValues(array $values): void
    {
        foreach ($values as $name => $value) {
            $this->bindValue($name, $value);
        }
    }

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
