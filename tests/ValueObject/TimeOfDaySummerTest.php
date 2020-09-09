<?php declare(strict_types=1);

namespace Test\ValueObject;

use Example\ValueObject\TimeOfDaySummer;
use PHPUnit\Framework\TestCase;
use DateTime;
use DateTimeInterface;

class TimeOfDaySummerTest extends TestCase
{

    public function testIsNight(): void
    {
        //ARRANGE
        $datetime = new DateTime('today');
        $datetime->setTime(0,0);
        $timeOfDay = new TimeOfDaySummer($datetime);

        //ACT
        $time = $timeOfDay->isNight();

        //Assert
        $this->assertTrue($time);
    }

    public function testIsMorning(): void
    {
        //ARRANGE
        $datetime = new DateTime('today');
        $datetime->setTime(8,0);
        $timeOfDay = new TimeOfDaySummer($datetime);

        //ACT
        $time = $timeOfDay->isMorning();

        //Assert
        $this->assertTrue($time);
    }

    public function testIsEvening(): void
    {
        //ARRANGE
        $datetime = new DateTime('today');
        $datetime->setTime(19,0);
        $timeOfDay = new TimeOfDaySummer($datetime);

        //ACT
        $time = $timeOfDay->isEvening();

        //Assert
        $this->assertTrue($time);
    }

    public function testIsAfternoon(): void
    {
        //ARRANGE
        $datetime = new DateTime('today');
        $datetime->setTime(13,0);
        $timeOfDay = new TimeOfDaySummer($datetime);

        //ACT
        $time = $timeOfDay->isAfternoon();

        //Assert
        $this->assertTrue($time);
    }

    /**
     * @dataProvider timeProvider
     */
    public function test__toString(DateTimeInterface $dateTime, string $expectedTime): void
    {
        //ARRANGE
        $timeOfDay = new TimeOfDaySummer($dateTime);

        //ACT
        $time = (string) $timeOfDay;

        //ASSERT
        $this->assertEquals($expectedTime, $time);
    }

    /**
     * @return mixed[]
     */
    public function timeProvider(): array
    {
        return [
            'Checks if Morning string is returned' =>
                [
                    ( new DateTime('today'))->setTime(8,0),
                    TimeOfDaySummer::MORNING
                ],
            'Checks if Afternoon string is returned' =>
                [
                    ( new DateTime('today'))->setTime(13,0),
                    TimeOfDaySummer::AFTERNOON
                ],
            'Checks if Evening  string is returned' =>
                [
                    ( new DateTime('today'))->setTime(19,0),
                    TimeOfDaySummer::EVENING
                ],
            'Checks if Night  string is returned' =>
                [
                    ( new DateTime('today'))->setTime(1,0),
                    TimeOfDaySummer::NIGHT
                ],
        ];
    }
}
