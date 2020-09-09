<?php declare(strict_types=1);

namespace Example\Services;

use Example\Exception\RaspberryNotActiveException;
use Example\Services\Interfaces\LightSwitcherInterface;
use Example\VendorComponent\RaspberryComponentInterface;

class BackyardLightSwitcher implements LightSwitcherInterface
{
    private RaspberryComponentInterface $device;

    public function __construct(RaspberryComponentInterface $device)
    {
        $this->device = $device;
    }

    /**
     * @throws RaspberryNotActiveException
     */
    public function lightOn(): void
    {
        if (!$this->device->isActive()) {
            throw new RaspberryNotActiveException();
        }

        $this->device->lightOn();
    }

    /**
     * @throws RaspberryNotActiveException
     */
    public function lightOff(): void
    {
        if (!$this->device->isActive()) {
            throw new RaspberryNotActiveException();
        }

        $this->device->lightOff();
    }
}
