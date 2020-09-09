<?php

namespace Example\Services\Interfaces;

use Example\Exception\RaspberryNotActiveException;

interface LightSwitcherInterface
{
    /**
     * @throws RaspberryNotActiveException
     */
    public function lightOn(): void;

    /**
     * @throws RaspberryNotActiveException
     */
    public function lightOff(): void;
}
