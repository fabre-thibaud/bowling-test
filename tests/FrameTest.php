<?php

declare(strict_types=1);

namespace Tests;

use App\Frame;
use App\RollGenerator;
use PHPUnit\Framework\TestCase;

class FrameTest extends TestCase
{

    public function testFrameIsStrikeWith10Roll(): void
    {
        $rollGenerator = new RollGenerator(10, null);

        $frame = new Frame($rollGenerator);

        $frame->throwFirstBall();

        $this->assertTrue($frame->isStrike());
        $this->assertFalse($frame->isSpare());
    }

    public function testFrameIsSpareWith5And5Rolls(): void
    {
        $rollGenerator = new RollGenerator(5, 5);

        $frame = new Frame($rollGenerator);

        $frame->throwFirstBall();

        $this->assertFalse($frame->isStrike());

        $frame->throwSecondBall();

        $this->assertTrue($frame->isSpare());
    }

    public function testFrameIsNotStrikeOrSpareWith2And3Rolls(): void
    {
        $rollGenerator = new RollGenerator(2, 3);

        $frame = new Frame($rollGenerator);

        $frame->throwFirstBall();

        $this->assertFalse($frame->isStrike());

        $frame->throwSecondBall();

        $this->assertFalse($frame->isSpare());
    }

    public function testFrameReturnsFirstRollResult()
    {
        $rollGenerator = new RollGenerator(2, 3);

        $frame = new Frame($rollGenerator);

        $frame->throwFirstBall();

        $this->assertEquals(2, $frame->getFirstRollResult());
    }


    public function testFrameReturnsSecondRollResult()
    {
        $rollGenerator = new RollGenerator(2, 3);

        $frame = new Frame($rollGenerator);

        $frame->throwFirstBall();
        $frame->throwSecondBall();

        $this->assertEquals(2, $frame->getFirstRollResult());
        $this->assertEquals(3, $frame->getSecondRollResult());
    }

    public function getScoreDataSet(): array
    {
        return [
            [2, 3, 5],
            [10, 0, 10],
            [5, 5, 10]
        ];
    }

    /**
     * @dataProvider getScoreDataSet
     * @return void
     */
    public function testFrameReturnsTotalScoreWithoutBonus($firstRoll, $secondRoll, $expectedTotal)
    {
        $rollGenerator = new RollGenerator($firstRoll, $secondRoll);

        $frame = new Frame($rollGenerator);

        $frame->throwFirstBall();
        $frame->throwSecondBall();

        $this->assertEquals($expectedTotal, $frame->getTotalScore());
    }
}
