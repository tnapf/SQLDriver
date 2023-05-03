<?php

namespace Tnapf\Driver;

class DsnBuilder
{
    public const PREFIX_MYSQL = "mysql";
    public const PREFIX_POSTGRES = "pgsql";
    public const PREFIX_CUBRID = "cubrid";
    public const PREFIX_ORACLE = "oci";
    public const PREFIX_SQLITE = "sqlite";
    public const PREFIX_ODBC = "odbc";
    public const PREFIX_IBM = "ibm";
    public const PREFIX_MS_SQL = "sqlsrv";
    public const PREFIX_MS_SQL_LIB = "sybase";
    public const PREFIX_INFORMIX = "informix";
    public const PREFIX_FIREBIRD = "firebird";

    protected string $prefix = self::PREFIX_MYSQL;
    protected array $config = [];

    public static function createMySQLDsn(
        string $dbname,
        string $host = "127.0.0.1",
        int $port = 3306,
        ?string $unix_socket = null,
        ?string $charset = null
    ): self {
        $dsn = new self();
        $dsn->config = compact('host', 'port', 'dbname', 'unix_socket', 'charset');
    }

    public static function createPostgresDsn(
        string $dbname,
        string $host = "127.0.0.1",
        int $port = 5432,
        ?string $sslMode = null
    ): self {
        $dsn = new self();
        $dsn->config = compact('host', 'port', 'dbname', 'sslMode');
        $dsn->prefix = self::PREFIX_POSTGRES;
        return $dsn;
    }

    public function setPrefix(string $prefix): self
    {
        $this->prefix = $prefix;
        return $this;
    }

    public function setDsnProp(string $prop, string|int $value): self
    {
        $this->config[$prop] = $value;
        return $this;
    }

    public function getDsnProp(string $prop): string|int|null
    {
        return $this->config[$prop] ?? null;
    }

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

    public function __toString(): string
    {
        return $this->buildDsn($this->prefix, $this->config);
    }
}
