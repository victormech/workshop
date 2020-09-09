<?php declare(strict_types=1);

namespace Example\Services;

use Example\Exception\RaspberryNotActiveException;
use Example\Services\Interfaces\LightSwitcherInterface;
use Example\Services\Interfaces\TimeOfDayProviderInterface;
use Exception;

class SmartHome
{
    private LightSwitcherInterface $lightSwitcher;
    private TimeOfDayProviderInterface $timeProvider;

    public function __construct(LightSwitcherInterface $lightSwitcher, TimeOfDayProviderInterface $timeProvider)
    {
        $this->lightSwitcher = $lightSwitcher;
        $this->timeProvider = $timeProvider;
    }

    /**
     * @throws RaspberryNotActiveException
     * @throws Exception
     */
    public function activateLights(): void
    {
        $timeOfDay = $this->timeProvider->create();

        if ($timeOfDay->isNight() || $timeOfDay->isEvening()) {
            $this->lightSwitcher->lightOn();

            return;
        }

        $this->lightSwitcher->lightOff();
    }

    /**
     * @throws RaspberryNotActiveException
     */
    public function deactivateLights(): void
    {
        $this->lightSwitcher->lightOff();
    }
}
