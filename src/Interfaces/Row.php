<?php

namespace Tnapf\Driver\Interfaces;

use JsonSerializable;

interface Row extends JsonSerializable
{
    public function getColumns(): array;

    public function getColumn(string $columnName): mixed;

    public function getRaw(): array;
}
