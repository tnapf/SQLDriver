<?php

namespace Tnapf\Driver;

use Tnapf\Driver\Interfaces\DriverInterface;
use Tnapf\Driver\Interfaces\QueryInterface;

class Query implements QueryInterface
{
    public function __construct(
        public readonly string $query,
        public readonly DriverInterface $driver
    ) {
    }

    public function execute(): QueryResponse
    {
        return new QueryResponse($this->driver->pdo->query($this->query));
    }
}
