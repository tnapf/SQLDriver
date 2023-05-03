<?php

namespace Tnapf\Driver\Interfaces;

interface QueryInterface
{
    public function __construct(string $query, DriverInterface $driver);
    public function execute(): QueryResponseInterface;
}
