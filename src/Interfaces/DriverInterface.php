<?php

namespace Tnapf\Driver\Interfaces;

use Tnapf\Driver\DsnBuilder;
use Tnapf\Driver\Enums\DatabaseTypes;

interface DriverInterface
{
    public function query(string $query): QueryInterface;

    public function preparedQuery(string $query): PreparedQueryInterface;

    public function isConnected(): bool;

    public function connect(): void;

    public function disconnect(): void;
}
