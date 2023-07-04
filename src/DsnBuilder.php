<?php

namespace Tnapf\Driver;

/**
 * Builds a DSN string.
 *
 * @package Tnapf\Driver
 */
class DsnBuilder
{
    /** @var string MySQL prefix */
    public const PREFIX_MYSQL = "mysql";

    /** @var string PostgreSQL prefix */
    public const PREFIX_POSTGRES = "pgsql";

    /** @var string Cubrid prefix */
    public const PREFIX_CUBRID = "cubrid";

    /** @var string Oracle prefix */
    public const PREFIX_ORACLE = "oci";

    /** @var string SQLite prefix */
    public const PREFIX_SQLITE = "sqlite";

    /** @var string ODBC prefix */
    public const PREFIX_ODBC = "odbc";

    /** @var string IBM prefix */
    public const PREFIX_IBM = "ibm";

    /** @var string Microsoft SQL prefix */
    public const PREFIX_MS_SQL = "sqlsrv";

    /** @var string Microsoft SQL lib prefix */
    public const PREFIX_MS_SQL_LIB = "sybase";

    /** @var string Informix prefix */
    public const PREFIX_INFORMIX = "informix";

    /** @var string Firebird prefix */
    public const PREFIX_FIREBIRD = "firebird";

    protected string $prefix = self::PREFIX_MYSQL;
    protected array $config = [];

    /**
     * Creates a new DsnBuilder for MySQL.
     *
     * @param string $dbname
     * @param string|null $host
     * @param int|null $port
     * @param string|null $unix_socket
     * @param string|null $charset
     * @return self
     */
    public static function createMySQLDsn(
        string $dbname,
        string|null $host = null,
        int|null $port = null,
        string|null $unix_socket = null,
        string|null $charset = null
    ): self {
        $port ??= 3306;
        $host ??= "127.0.0.1";
        $dsn = new self();
        $dsn->config = compact('host', 'port', 'dbname', 'unix_socket', 'charset');
        return $dsn;
    }

    /**
     * Creates a new DsnBuilder for PostgreSQL.
     *
     * @param string $dbname
     * @param string|null $host
     * @param int|null $port
     * @param string|null $sslMode
     * @return self
     */
    public static function createPostgresDsn(
        string $dbname,
        string|null $host = null,
        int|null $port = null,
        string|null $sslMode = null
    ): self {
        $port ??= 5432;
        $host ??= "127.0.0.1";
        $dsn = new self();
        $dsn->config = compact('host', 'port', 'dbname', 'sslMode');
        $dsn->prefix = self::PREFIX_POSTGRES;
        return $dsn;
    }

    /**
     * Sets the prefix for the DSN.
     *
     * @param string $prefix
     * @return $this
     */
    public function setPrefix(string $prefix): self
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     * Sets a DSN property.
     *
     * @param string $prop
     * @param string|int $value
     * @return $this
     */
    public function setDsnProp(string $prop, string|int $value): self
    {
        $this->config[$prop] = $value;
        return $this;
    }

    /**
     * Returns a DSN property.
     *
     * @param string $prop
     * @return string|int|null
     */
    public function getDsnProp(string $prop): string|int|null
    {
        return $this->config[$prop] ?? null;
    }

    /**
     * Builds a DSN string.
     *
     * @param string $prefix
     * @param array $props
     * @return string
     */
    public static function buildDsn(string $prefix, array $props): string
    {
        $dsn = "{$prefix}:";
        foreach ($props as $name => $value) {
            if ($value === null) {
                continue;
            }

            $dsn .= "{$name}={$value};";
        }

        return $dsn;
    }

    /**
     * Returns the DSN string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->buildDsn($this->prefix, $this->config);
    }

    /**
     * Creates a new DsnBuilder.
     *
     * @return self
     */
    public static function new(): self
    {
        return new self();
    }
}
