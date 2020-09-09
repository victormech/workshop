<?php

namespace Example\Services\Interfaces;

use Example\ValueObject\Interfaces\TimeOfDayInterface;

interface TimeOfDayProviderInterface
{
    public function create(): TimeOfDayInterface;
}
