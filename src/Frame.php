<?php

declare(strict_types=1);

namespace App;

class Frame
{

    private $rollGenerator;

    private $firstRollResult;

    private $secondRollResult;

    public function __construct(RollGenerator $rollGenerator)
    {
        $this->rollGenerator = $rollGenerator;
    }

    public function throwFirstBall(): void
    {
        $this->firstRollResult = $this->rollGenerator->generateFirstRoll();
    }

    public function throwSecondBall(): void
    {
        $this->secondRollResult = $this->rollGenerator->generateSecondRoll();
    }

    public function isStrike(): bool
    {
        return $this->firstRollResult === 10;
    }

    public function isSpare(): bool
    {
        return !$this->isStrike() && $this->firstRollResult + $this->secondRollResult === 10;
    }

    public function getFirstRollResult(): int
    {
        return (int) $this->firstRollResult;
    }

    public function getSecondRollResult(): int
    {
        return (int) $this->secondRollResult;
    }

    public function getTotalScore(): int
    {
        if ($this->isStrike()) {
            return $this->firstRollResult;
        }

        return $this->firstRollResult + $this->secondRollResult;
    }
}
