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

class PDODriver implements DriverInterface
{
    public readonly PDO $pdo;
    protected static self $instance;

    /**
     * @throws DriverException
     */
    public function __construct(
        protected string $dsn,
        protected string $username,
        protected string $password,
        protected array $options = []
    ) {
        $this->connect();
    }

    public function query(string $query): QueryInterface
    {
        return new Query($query, $this);
    }

    public function preparedQuery(string $query): PreparedQueryInterface
    {
        return new PreparedQuery($query, $this);
    }

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

    public function disconnect(): void
    {
        unset($this->pdo);
    }

    public function isConnected(): bool
    {
        return isset($this->pdo);
    }
}
