<?php

declare(strict_types=1);

namespace App;

class RollGenerator
{

    private $firstRoll;

    private $secondRoll;

    public function __construct(int $firstRoll, ?int $secondRoll = null)
    {
        $this->firstRoll = $firstRoll;
        $this->secondRoll = $secondRoll;
    }

    public function generateFirstRoll(): int
    {
        return $this->firstRoll;
    }

    public function generateSecondRoll(): ?int
    {
        return $this->secondRoll;
    }
}
