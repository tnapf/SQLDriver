<?php

namespace Tnapf\Driver;

use Tnapf\Driver\Interfaces\DriverInterface;
use Tnapf\Driver\Interfaces\QueryResponse;

class PreparedQuery implements Interfaces\PreparedQuery
{
    public function __construct(
        public readonly string $query,
        public readonly DriverInterface $driver
    )
    {
    }

    public function bindValue(string $name, mixed $value): void
    {
        // TODO: Implement bindValue() method.
    }

    public function bindValues(array $values): void
    {
        // TODO: Implement bindValues() method.
    }

    public function execute(): QueryResponse
    {
        // TODO: Implement execute() method.
    }
}