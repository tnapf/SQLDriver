<?php

namespace Tnapf\Driver\Interfaces;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use JsonSerializable;
use Tnapf\Driver\Enums\FetchTypes;
use Tnapf\Driver\Interfaces\RowInterface;

interface QueryResponseInterface extends Countable, JsonSerializable
{
    /**
     * @param int $fetchType
     * @return RowInterface[]
     */
    public function fetchRows(int $fetchType = 0): array;
    public function fetchNextRow(int $fetchType = 0): ?RowInterface;
    public function fetchLastRow(int $fetchType = 0): ?RowInterface;
    public function fetchFirstRow(int $fetchType = 0): ?RowInterface;
    public function getRowCount(): int;
}
