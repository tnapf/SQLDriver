<?php

namespace Tnapf\Driver\Interfaces;

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
}
