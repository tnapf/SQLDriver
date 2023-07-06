<?php

namespace Tnapf\Driver\Interfaces;

use Tnapf\Driver\Exceptions\QueryException;

interface QueryInterface
{
    /**
     * QueryInterface constructor.
     *
     * @param string $query           The SQL query to execute or prepare.
     * @param DriverInterface $driver The driver instance to use for this query.
     */
    public function __construct(string $query, DriverInterface $driver);

    /**
     * Execute the query and return a QueryResponseInterface instance.
     *
     * @return QueryResponseInterface The response object containing the results of the query execution.
     *
     * @throws QueryException on failure.
     */
    public function execute(): QueryResponseInterface;
}
