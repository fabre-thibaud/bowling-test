<?php

declare(strict_types=1);

namespace App;

class Game
{

    private $rollGenerator;

    /**
     * @var Frame[]
     */
    private $frames = [];

    private $finalScore = 0;

    public function __construct(RollGenerator $rollGenerator)
    {
        $this->rollGenerator = $rollGenerator;
    }

    public function playGame(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $this->frames[] = $this->playFrame();
        }

        $lastFrame = $this->frames[count($this->frames) - 1];

        if ($lastFrame->isStrike() || $lastFrame->isSpare()) {
            $this->frames[]  = $this->playFrame(true);
        }

        if ($lastFrame->isStrike()) {
            $this->frames[]  = $this->playFrame(true);
        }
    }

    public function getTotalScore(): int
    {
        for ($i = 0; $i < 10; $i++) {
            $this->finalScore += $this->calculateFrameScore(
                $this->frames[$i],
                $this->frames[$i + 1] ?? null,
                $this->frames[$i + 2] ?? null,
            );
        }

        return $this->finalScore;
    }

    private function calculateFrameScore(Frame $frame, ?Frame $nextFrame = null, ?Frame $secondNextFrame = null): int
    {
        $frameScore = $frame->getTotalScore();

        if ($frame->isSpare()) {
            $frameScore += $nextFrame !== null ? $nextFrame->getFirstRollResult() : 0;
        }

        if ($frame->isStrike()) {
            $frameScore += $nextFrame !== null ? $nextFrame->getTotalScore() : 0;
            $frameScore += $secondNextFrame !== null ? $secondNextFrame->getTotalScore() : 0;
        }

        return $frameScore;
    }

    /**
     * @return Frame
     */
    private function playFrame(bool $isFinalFrame = false): Frame
    {
        $frame = new Frame($this->rollGenerator);

        $frame->throwFirstBall();

        if (!$frame->isStrike() && !$isFinalFrame) {
            $frame->throwSecondBall();
        }

        return $frame;
    }
}
