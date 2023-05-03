<?php

namespace Tnapf\Driver;

use PDOStatement;
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
        $this->stmt->bindValue($name, $value);
    }

    public function bindValues(array $values): void
    {
        foreach ($values as $name => $value) {
            $this->bindValue($name, $value);
        }
    }

    public function execute(): QueryResponseInterface
    {
        $this->stmt->execute();
        return new QueryResponse($this->stmt);
    }
}
