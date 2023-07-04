<?php

namespace Tnapf\Driver;

use PDO;
use PDOException;
use Tnapf\Driver\Exceptions\DriverException;
use Tnapf\Driver\Interfaces\DriverInterface;
use Tnapf\Driver\Interfaces\PreparedQueryInterface;
use Tnapf\Driver\Interfaces\QueryInterface;

class PDODriver implements DriverInterface
{
    public readonly PDO $pdo;

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

    /**
     * @throws DriverException
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
            throw DriverException::createFromPdo($e);
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

    /**
     * @throws DriverException
     */
    public function begin(): void
    {
        try {
            if (!$this->pdo->beginTransaction()) {
                throw new DriverException('Failed to begin transaction.');
            }
        } catch (PDOException $e) {
            throw DriverException::createFromPdo($e);
        }
    }

    /**
     * @throws DriverException
     */
    public function commit(): void
    {
        try {
            if (!$this->pdo->commit()) {
                throw new DriverException('Failed to commit transaction.');
            }
        } catch (PDOException $e) {
            throw DriverException::createFromPdo($e);
        }
    }

    /**
     * @throws DriverException
     */
    public function rollback(): void
    {
        try {
            if (!$this->pdo->rollBack()) {
                throw new DriverException('Failed to rollback transaction.');
            }
        } catch (PDOException $e) {
            throw DriverException::createFromPdo($e);
        }
    }

    public function inTransaction(): bool
    {
        return $this->pdo->inTransaction();
    }
}
