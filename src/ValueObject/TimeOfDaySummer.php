<?php declare(strict_types=1);

namespace Example\ValueObject;

use DateTimeInterface;
use Example\ValueObject\Interfaces\TimeOfDayInterface;

class TimeOfDaySummer implements TimeOfDayInterface
{
    public const MORNING = 'Morning';
    public const NIGHT = 'Night';
    public const AFTERNOON = 'Afternoon';
    public const EVENING = 'Evening';

    private int $hour;

    public function __construct(DateTimeInterface $dateTime)
    {
        $this->hour = (int) $dateTime->format('H');
    }

    public function isMorning(): bool
    {
        return $this->hour >= 6 && $this->hour < 12;
    }

    public function isAfternoon(): bool
    {
        return $this->hour >= 12 && $this->hour < 18;
    }

    public function isNight(): bool
    {
        return $this->hour >= 0 && $this->hour < 6;
    }

    public function isEvening(): bool
    {
        return $this->hour >= 18 && $this->hour <= 23;
    }

    public function __toString(): string
    {
        if ($this->isNight()) {
            return self::NIGHT;
        }

        if ($this->isMorning()) {
            return self::MORNING;
        }

        if ($this->isEvening()) {
            return self::EVENING;
        }

        return self::AFTERNOON;
    }
}
