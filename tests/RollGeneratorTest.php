<?php

declare(strict_types=1);

namespace Tests;

use App\RollGenerator;
use PHPUnit\Framework\TestCase;

class RollGeneratorTest extends TestCase
{

    public function testGeneratorReturnsAssignedValues(): void
    {
        $generator = new RollGenerator(1, 2);

        $this->assertEquals(1, $generator->generateFirstRoll());
        $this->assertEquals(2, $generator->generateSecondRoll());
    }

    public function testGeneratorReturnsNullRoll(): void
    {
        $generator = new RollGenerator(1, null);

        $this->assertEquals(1, $generator->generateFirstRoll());
        $this->assertEquals(null, $generator->generateSecondRoll());
    }
}
