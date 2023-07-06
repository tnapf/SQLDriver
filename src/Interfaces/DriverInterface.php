<?php

namespace Tnapf\Driver\Interfaces;

use Tnapf\Driver\Exceptions\DriverException;

interface DriverInterface
{
    /**
     * Execute a query and return a QueryInterface instance.
     *
     * @param string $query The SQL query to execute.
     */
    public function query(string $query): QueryInterface;

    /**
     * Prepare a query and return a PreparedQueryInterface instance.
     *
     * @param string $query The SQL query to prepare.
     */
    public function preparedQuery(string $query): PreparedQueryInterface;

    /**
     * Check if the driver is connected to the database.
     *
     * @return bool True if connected, false otherwise.
     */
    public function isConnected(): bool;

    /**
     * Connect the driver to the database.
     */
    public function connect(): void;

    /**
     * Disconnect the driver from the database.
     */
    public function disconnect(): void;

    /**
     * Begins a transactions.
     *
     * Some DBMS may create implicit COMMIT on DML queries.
     *
     * @throws DriverException on failure.
     */
    public function begin(): void;

    /**
     * Rolls back a transaction.
     *
     * @throws DriverException on failure.
     */
    public function rollback(): void;

    /**
     * Commits a transaction.
     *
     * @throws DriverException on failure.
     */
    public function commit(): void;

    /**
     * Returns whether a transaction is active.
     */
    public function inTransaction(): bool;
}
