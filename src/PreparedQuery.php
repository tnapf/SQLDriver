<?php

namespace Tnapf\Driver;

use Tnapf\Driver\Interfaces\DriverInterface;
use Tnapf\Driver\Interfaces\QueryResponseInterface;

class PreparedQuery implements Interfaces\PreparedQueryInterface
{
    public function __construct(
        public readonly string $query,
        public readonly DriverInterface $driver
    ) {
    }

    public function bindValue(string $name, mixed $value): void
    {
        // TODO: Implement bindValue() method.
    }

    public function bindValues(array $values): void
    {
        // TODO: Implement bindValues() method.
    }

    public function execute(): QueryResponseInterface
    {
        // TODO: Implement execute() method.
    }
}
