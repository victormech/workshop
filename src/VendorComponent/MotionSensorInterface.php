<?php

namespace Example\VendorComponent;

interface MotionSensorInterface
{
    public function motionDetected(): bool;
}
