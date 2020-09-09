<?php

namespace Example\ValueObject\Interfaces;

interface TimeOfDayInterface
{
    public function isMorning(): bool;

    public function isAfternoon(): bool;

    public function isNight(): bool;

    public function isEvening(): bool;

    public function __toString(): string;
}
