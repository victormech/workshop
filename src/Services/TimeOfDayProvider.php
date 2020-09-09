<?php declare(strict_types=1);

namespace Example\Services;

use DateTimeImmutable;
use Example\Services\Interfaces\TimeOfDayProviderInterface;
use Example\ValueObject\Interfaces\TimeOfDayInterface;
use Example\ValueObject\TimeOfDaySummer;

class TimeOfDayProvider implements TimeOfDayProviderInterface
{
    public function create(): TimeOfDayInterface
    {
        //Fancy code to check the current season

        return new TimeOfDaySummer(new DateTimeImmutable('now'));
    }
}
