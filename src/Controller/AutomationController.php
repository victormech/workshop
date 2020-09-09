<?php declare(strict_types=1);

namespace Example\Controller;

use Example\Exception\MotionDectectionException;
use Example\Exception\RaspberryNotActiveException;
use Example\Services\BackyardLightSwitcher;
use Example\Services\SmartHome;
use Example\Services\TimeOfDayProvider;
use Example\VendorComponent\FakeMotionSensor;
use Example\VendorComponent\RaspberryFakeComponent;
use Exception;


class AutomationController
{
    /**
     * @throws RaspberryNotActiveException
     * @throws Exception
     */
    public function motionDetectedAction(): void
    {
        try {
            $motionDetector = new FakeMotionSensor();

            $device = new RaspberryFakeComponent();
            $switcher = new BackyardLightSwitcher($device);
            $timeProvider = new TimeOfDayProvider();
            $smartHome = new SmartHome($switcher, $timeProvider);

            if ($motionDetector->motionDetected()) {
                echo 'Motion detected' . PHP_EOL;
                $smartHome->activateLights();

                return;
            }

            echo 'Nothing detected' . PHP_EOL;
            $smartHome->deactivateLights();
        } catch (RaspberryNotActiveException | MotionDectectionException $exception) {
            echo $exception->getMessage();
        }
    }
}
