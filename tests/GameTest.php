<?php

declare(strict_types=1);

namespace Tests;

use App\Game;
use App\RollGenerator;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{

    public function testScoreIs300WithAllStrikes(): void
    {
        $rollGenerator = new RollGenerator(10, null);
        $game = new Game($rollGenerator);

        $game->playGame();

        $this->assertEquals(300, $game->getTotalScore());
    }

    public function testScoreIs90WithTenNinesAndTenMisses(): void
    {
        $rollGenerator = new RollGenerator(9, 0);
        $game = new Game($rollGenerator);

        $game->playGame();

        $this->assertEquals(90, $game->getTotalScore());
    }

    public function testScoreIs150WithTenSpares(): void
    {
        $rollGenerator = new RollGenerator(5, 5);
        $game = new Game($rollGenerator);

        $game->playGame();

        $this->assertEquals(150, $game->getTotalScore());
    }
}


