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
     * @param int $type
     * @return Row[]
     */
    public function fetchRows(int $fetchType = 0): array;
    public function fetchNextRow(int $fetchType = 0): ?Row;
    public function fetchLastRow(int $fetchType = 0): ?Row;
    public function fetchFirstRow(int $fetchType = 0): ?Row;
    public function getRowCount(): int;
}
