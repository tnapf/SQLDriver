<?php

namespace Tnapf\Driver;

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
        return new QueryResponse($this->driver->pdo->query($this->query));
    }
}
