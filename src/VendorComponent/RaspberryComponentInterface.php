<?php

namespace Example\VendorComponent;

interface RaspberryComponentInterface
{
    public function isActive(): bool;

    public function lightOn(): void;

    public function lightOff(): void;
}
