<?php declare(strict_types=1);

namespace Example\Exception;

use RuntimeException;

class RaspberryNotActiveException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('Raspberry device not active', 500);
    }
}
