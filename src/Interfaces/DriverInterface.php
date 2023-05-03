<?php

namespace Tnapf\Driver\Interfaces;

use Tnapf\Driver\DsnBuilder;
use Tnapf\Driver\Enums\DatabaseTypes;

interface DriverInterface
{
    public function query(string $query): Query;

    public function preparedQuery(string $query): PreparedQuery;

    public function isConnected(): bool;

    public function connect(): void;

    public function disconnect(): void;
}
