<?php declare(strict_types=1);

namespace Example\Exception;

use RuntimeException;

class MotionDectectionException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('Motion Detection device failed', 500);
    }
}
