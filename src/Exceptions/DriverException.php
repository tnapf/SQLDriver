<?php

namespace Tnapf\Driver\Exceptions;

use Exception;
use PDOException;

class DriverException extends Exception
{
    public static function createFromPdo(PDOException $e): DriverException
    {
        return new DriverException($e->getMessage(), $e->getCode());
    }
}
