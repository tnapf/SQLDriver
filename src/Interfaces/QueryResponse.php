<?php

namespace Tnapf\Driver\Interfaces;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use JsonSerializable;
use Tnapf\Driver\Enums\FetchTypes;
use Tnapf\Driver\Interfaces\Row;

interface QueryResponse extends Countable, JsonSerializable
{
    /**
     * @return Row[]
     */
    public function fetchRows(): array;
    public function fetchNextRow(): ?Row;
    public function fetchLastRow(): ?Row;
    public function fetchFirstRow(): ?Row;
    public function getRowCount(): int;
}
