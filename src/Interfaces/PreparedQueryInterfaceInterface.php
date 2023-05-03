<?php

namespace Tnapf\Driver\Interfaces;

interface PreparedQueryInterfaceInterface extends QueryInterface
{
    public function bindValue(string $name, mixed $value): void;
    public function bindValues(array $values): void;
}
