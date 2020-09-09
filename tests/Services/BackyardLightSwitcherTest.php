<?php declare(strict_types=1);

namespace Test\Services;

use Example\Exception\RaspberryNotActiveException;
use Example\Services\BackyardLightSwitcher;
use Example\VendorComponent\RaspberryComponentInterface;
use PHPUnit\Framework\TestCase;

class BackyardLightSwitcherTest extends TestCase
{

    public function testLightOn(): void
    {
        //ARRANGE
        $mock = $this->createMock(RaspberryComponentInterface::class);
        $service = new BackyardLightSwitcher($mock);

        $mock
            ->method('isActive')
            ->willReturn(true);

        $mock
            ->expects($spy = $this->any())
            ->method('lightOn');


        //ACT
        $service->lightOn();

        //ASSERT
        $this->assertEquals(1, $spy->getInvocationCount());
    }

    public function testLightOff(): void
    {
        //ARRANGE
        $mock = $this->createMock(RaspberryComponentInterface::class);
        $service = new BackyardLightSwitcher($mock);

        $mock
            ->method('isActive')
            ->willReturn(true);

        $mock
            ->expects($spy = $this->any())
            ->method('lightOff');

        //ACT
        $service->lightOff();

        //ASSERT
        $this->assertEquals(1, $spy->getInvocationCount());
    }

    public function testBrokenDeviceTurnOn(): void
    {
        //ARRANGE
        $mock = $this->createMock(RaspberryComponentInterface::class);
        $service = new BackyardLightSwitcher($mock);

        $mock
            ->method('isActive')
            ->willReturn(false);

        //ASSERT
        $this->expectException(RaspberryNotActiveException::class);

        //ACT
        $service->lightOn();
    }

    public function testBrokenDeviceTurnOff(): void
    {
        //ARRANGE
        $mock = $this->createMock(RaspberryComponentInterface::class);
        $service = new BackyardLightSwitcher($mock);

        $mock
            ->method('isActive')
            ->willReturn(false);

        //ASSERT
        $this->expectException(RaspberryNotActiveException::class);

        //ACT
        $service->lightOff();

    }
}
