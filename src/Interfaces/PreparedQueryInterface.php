<?php

namespace Tnapf\Driver\Interfaces;

interface PreparedQueryInterface extends QueryInterface
{
    public function bindValue(string $name, mixed $value): void;
    public function bindValues(array $values): void;
}
