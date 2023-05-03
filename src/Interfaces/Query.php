<?php

namespace Tnapf\Driver\Interfaces;

interface Query
{
    public function __construct(string $query, DriverInterface $driver);
    public function execute(): QueryResponse;
}
