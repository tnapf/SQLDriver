<?php

namespace Tnapf\Driver;

use Tnapf\Driver\Interfaces\DriverInterface;
use Tnapf\Driver\QueryResponseInterface;

class QueryInterface implements Interfaces\QueryInterface
{
    public function __construct(
        public readonly string $query,
        public readonly DriverInterface $driver
    ) {
    }

    public function execute(): QueryResponseInterface
    {
        return new QueryResponseInterface($this->driver->pdo->query($this->query));
    }
}
