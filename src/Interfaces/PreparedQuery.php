<?php

namespace Tnapf\Driver\Interfaces;

interface PreparedQuery extends Query
{
    public function bindValue(string $name, mixed $value): void;
    public function bindValues(array $values): void;
}
