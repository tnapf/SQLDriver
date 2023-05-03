<?php

namespace Tnapf\Driver\Interfaces;

use Stringable;

interface Row extends Stringable
{
    public function getColumns(): array;
    public function getColumn(string $columnName): mixed;
    public function getColumnNames(): array;
    public function toArray(): array;
}
