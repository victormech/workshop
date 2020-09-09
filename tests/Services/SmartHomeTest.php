<?php declare(strict_types=1);

namespace Test\Services;

use Example\Exception\RaspberryNotActiveException;
use Example\Services\Interfaces\LightSwitcherInterface;
use Example\Services\Interfaces\TimeOfDayProviderInterface;
use Example\Services\SmartHome;
use Example\ValueObject\Interfaces\TimeOfDayInterface;
use PHPUnit\Framework\TestCase;

class SmartHomeTest extends TestCase
{
    public function testActivateLightsInTheNight()
    {
        //ARRANGE
        $providerMock = $this->createMock(TimeOfDayProviderInterface::class);
        $timeOfDayMock = $this->createMock(TimeOfDayInterface::class);

        $switcherMock = $this->createMock(LightSwitcherInterface::class);

        $timeOfDayMock
            ->method('isNight')
            ->willReturn(true);

        $timeOfDayMock
            ->method('isEvening')
            ->willReturn(false);

        $providerMock
            ->method('create')
            ->willReturn($timeOfDayMock);

        $switcherMock
            ->expects($spy = $this->atLeastOnce())
            ->method('lightOn');

        $service = new SmartHome($switcherMock, $providerMock);

        //ACT
        $service->activateLights();

        //ASSERT
        $this->assertEquals(1, $spy->getInvocationCount());
        $this->assertTrue($spy->hasBeenInvoked());
    }

    public function testActivateLightsInTheEvening()
    {
        //ARRANGE
        $providerMock = $this->createMock(TimeOfDayProviderInterface::class);
        $timeOfDayMock = $this->createMock(TimeOfDayInterface::class);

        $switcherMock = $this->createMock(LightSwitcherInterface::class);

        $timeOfDayMock
            ->method('isNight')
            ->willReturn(false);

        $timeOfDayMock
            ->method('isEvening')
            ->willReturn(true);

        $providerMock
            ->method('create')
            ->willReturn($timeOfDayMock);

        $switcherMock
            ->expects($spy = $this->atLeastOnce())
            ->method('lightOn');

        $service = new SmartHome($switcherMock, $providerMock);

        //ACT
        $service->activateLights();

        //ASSERT
        $this->assertEquals(1, $spy->getInvocationCount());
        $this->assertTrue($spy->hasBeenInvoked());
    }

    public function testNotActivateLights()
    {
        //ARRANGE
        $providerMock = $this->createMock(TimeOfDayProviderInterface::class);
        $timeOfDayMock = $this->createMock(TimeOfDayInterface::class);

        $switcherMock = $this->createMock(LightSwitcherInterface::class);

        $timeOfDayMock
            ->method('isNight')
            ->willReturn(false);

        $timeOfDayMock
            ->method('isEvening')
            ->willReturn(false);

        $providerMock
            ->method('create')
            ->willReturn($timeOfDayMock);

        $switcherMock
            ->expects($spy = $this->atLeastOnce())
            ->method('lightOff');

        $service = new SmartHome($switcherMock, $providerMock);

        //ACT
        $service->activateLights();

        //ASSERT
        $this->assertEquals(1, $spy->getInvocationCount());
        $this->assertTrue($spy->hasBeenInvoked());
    }

    public function testDeactivateLights(): void
    {
        //ARRANGE
        $providerMock = $this->createMock(TimeOfDayProviderInterface::class);
        $switcherMock = $this->createMock(LightSwitcherInterface::class);

        $switcherMock
            ->expects($spy = $this->atLeastOnce())
            ->method('lightOff');

        $service = new SmartHome($switcherMock, $providerMock);

        //ACT
        $service->deactivateLights();

        //ASSERT
        $this->assertEquals(1, $spy->getInvocationCount());
        $this->assertTrue($spy->hasBeenInvoked());
    }
}
