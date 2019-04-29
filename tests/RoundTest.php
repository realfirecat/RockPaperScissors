<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use \htl3r\rps\php\Round;

final class RoundTest extends TestCase
{
    public function testCanBeCreated(): void
    {
        $this->assertInstanceOf(
            Round::class,
            new Round()
        );
    }

    public function testCanBeCreatedAndNewRoundIsCalledWithInvalidChoice(): void
    {
        $round = new Round();
        $round->newRound("2");
        $this->assertEquals(
            $round->playerChoice,
            2
        );
    }
}