<?php declare(strict_types=1);

namespace Example\VendorComponent;

use Example\Exception\MotionDectectionException;
use Exception;

class FakeMotionSensor implements MotionSensorInterface
{
    /**
     * @throws MotionDectectionException
     */
    public function motionDetected(): bool
    {
        try {
            return random_int(0, 1) < 0.5;
        } catch (Exception $exception) {
            throw new MotionDectectionException();
        }
    }
}
