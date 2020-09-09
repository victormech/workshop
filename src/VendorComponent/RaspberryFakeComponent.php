<?php declare(strict_types=1);

namespace Example\VendorComponent;

class RaspberryFakeComponent implements RaspberryComponentInterface
{
    public function isActive(): bool
    {
        return true;
    }

    public function lightOn(): void
    {
        echo 'light on' . PHP_EOL;
    }

    public function lightOff(): void
    {
        echo 'light off' . PHP_EOL;
    }
}
