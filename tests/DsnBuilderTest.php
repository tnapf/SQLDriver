<?php

namespace Tests\Tnapf\Driver;

use PHPUnit\Framework\TestCase;
use Tnapf\Driver\DsnBuilder;

class DsnBuilderTest extends TestCase
{
    public function testSettingPrefix(): void
    {
        $builder = DsnBuilder::new()->setPrefix(DsnBuilder::PREFIX_MYSQL);

        $this->assertEquals("mysql:", (string)$builder);
    }

    public function testBuildingMySqlDsn(): void
    {
        $builder = DsnBuilder::createMySQLDsn("test", "localhost");

        $this->assertEquals("mysql:host=localhost;port=3306;dbname=test;", (string)$builder);
    }

    public function testBuilingPostgresDsn(): void
    {
        $builder = DsnBuilder::createPostgresDsn("test", "localhost");

        $this->assertEquals("pgsql:host=localhost;port=5432;dbname=test;", (string)$builder);
    }

    public function testManuallySettingProps(): void
    {
        $builder = DsnBuilder::new();

        $builder
            ->setPrefix(DsnBuilder::PREFIX_MYSQL)
            ->setDsnProp("host", "localhost")
            ->setDsnProp("port", "3306")
            ->setDsnProp("dbname", "test");

        $this->assertEquals("mysql:host=localhost;port=3306;dbname=test;", (string)$builder);
    }

    public function testGettingDsnProps(): void
    {
        $builder = DsnBuilder::new()->setDsnProp("host", "localhost");

        $this->assertEquals("localhost", $builder->getDsnProp("host"));
    }
}
