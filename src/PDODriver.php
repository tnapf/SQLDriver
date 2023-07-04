<?php

namespace Tnapf\Driver;

use PDO;
use PDOException;
use Tnapf\Driver\Exceptions\DriverException;
use Tnapf\Driver\Interfaces\DriverInterface;
use Tnapf\Driver\Interfaces\PreparedQueryInterface;
use Tnapf\Driver\Interfaces\QueryInterface;
use Tnapf\Driver\PreparedQuery;
use Tnapf\Driver\Query;
use Tnapf\Driver\Interfaces\QueryResponseInterface;

/**
 * Represents a PDO driver.
 *
 * @implements DriverInterface
 * @package Tnapf\Driver
 */
class PDODriver implements DriverInterface
{
    /**
     * Instance of PDO.
     *
     * @var PDO $pdo
     */
    public readonly PDO $pdo;

    /**
     * Instance of PDODriver.
     *
     * @var PDODriver $instance
     * @static
     */
    protected static self $instance;

    /**
     * Creates a new PDODriver.
     *
     * @param string $dsn The Data Source Name, or DSN, contains the information required to connect to the database.
     * @param string $username The username for the DSN string.
     * @param string $password The password for the DSN string.
     * @param array $options A key=>value array of driver-specific connection options.
     * @throws DriverException If the connection fails.
     */
    public function __construct(
        protected string $dsn,
        protected string $username,
        protected string $password,
        protected array $options = []
    ) {
        $this->connect();
    }

    /**
     * Creates a new Query.
     *
     * @param string $query
     * @return QueryInterface
     * @see Query
     */
    public function query(string $query): QueryInterface
    {
        return new Query($query, $this);
    }

    /**
     * Creates a new PreparedQuery.
     *
     * @param string $query
     * @return PreparedQueryInterface
     * @see PreparedQuery
     */
    public function preparedQuery(string $query): PreparedQueryInterface
    {
        return new PreparedQuery($query, $this);
    }

    /**
     * Connects to the database.
     *
     * @return void
     * @throws DriverException If the connection fails.
     */
    public function connect(): void
    {
        if ($this->isConnected()) {
            trigger_error("Already connected to database", E_USER_WARNING);
            return;
        }

        try {
            $this->pdo = new PDO($this->dsn, $this->username, $this->password, $this->options);
        } catch (PDOException $e) {
            throw new DriverException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Disconnects from the database.
     *
     * @return void
     */
    public function disconnect(): void
    {
        unset($this->pdo);
    }

    /**
     * Returns whether the driver is connected to the database.
     *
     * @return bool
     */
    public function isConnected(): bool
    {
        return isset($this->pdo);
    }
}
