<?php

namespace Tnapf\Driver;

class DsnBuilder
{
    /**
     * @deprecated use {@link DsnPrefix} cases instead.
     */
    public const PREFIX_MYSQL = DsnPrefix::MYSQL;
    /**
     * @deprecated use {@link DsnPrefix} cases instead.
     */
    public const PREFIX_POSTGRES = DsnPrefix::POSTGRES;
    /**
     * @deprecated use {@link DsnPrefix} cases instead.
     */
    public const PREFIX_CUBRID = DsnPrefix::CUBRID;
    /**
     * @deprecated use {@link DsnPrefix} cases instead.
     */
    public const PREFIX_ORACLE = DsnPrefix::ORACLE;
    /**
     * @deprecated use {@link DsnPrefix} cases instead.
     */
    public const PREFIX_SQLITE = DsnPrefix::SQLITE;
    /**
     * @deprecated use {@link DsnPrefix} cases instead.
     */
    public const PREFIX_ODBC = DsnPrefix::ODBC;
    /**
     * @deprecated use {@link DsnPrefix} cases instead.
     */
    public const PREFIX_IBM = DsnPrefix::IBM;
    /**
     * @deprecated use {@link DsnPrefix} cases instead.
     */
    public const PREFIX_MS_SQL = DsnPrefix::MS_SQL;
    /**
     * @deprecated use {@link DsnPrefix} cases instead.
     */
    public const PREFIX_MS_SQL_LIB = DsnPrefix::MS_SQL_LIB;
    /**
     * @deprecated use {@link DsnPrefix} cases instead.
     */
    public const PREFIX_INFORMIX = DsnPrefix::INFORMIX;
    /**
     * @deprecated use {@link DsnPrefix} cases instead.
     */
    public const PREFIX_FIREBIRD = DsnPrefix::FIREBIRD;

    protected DsnPrefix $prefix = DsnPrefix::MYSQL;
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
        return $dsn;
    }

    public static function createPostgresDsn(
        string $dbname,
        string $host = "127.0.0.1",
        int $port = 5432,
        ?string $sslMode = null
    ): self {
        $dsn = new self();
        $dsn->config = compact('host', 'port', 'dbname', 'sslMode');
        $dsn->prefix = DsnPrefix::POSTGRES;
        return $dsn;
    }

    public function setPrefix(string|DsnPrefix $prefix): self
    {
        if (is_string($prefix)) {
            $prefix = DsnPrefix::from($prefix);
        }

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

    public static function buildDsn(string|DsnPrefix $prefix, array $props): string
    {
        if (is_string($prefix)) {
            $prefix = DsnPrefix::from($prefix);
        }

        $dsn = "{$prefix->value}:";
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
        return static::buildDsn($this->prefix->value, $this->config);
    }

    public static function new(): self
    {
        return new self();
    }
}
