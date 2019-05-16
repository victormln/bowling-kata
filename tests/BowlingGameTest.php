<?php

namespace bowling\tests;


use bowling\BowlingGame;
use PHPUnit\Framework\TestCase;

class BowlingGameTest extends TestCase
{
    /** @var BowlingGame */
    private $game;

    public function setUp(): void
    {
        parent::setUp();
        $this->game = new BowlingGame();
    }

    /** @test **/
    public function testStandardFrame()
    {
        $this->game->roll(3);
        $this->game->roll(4);
        $this->assertEquals(7, $this->game->score());
    }

    /** @test **/
    public function testStandardGame()
    {
        $this->rolls(20, 4);
        $this->assertEquals(80, $this->game->score());
    }

    /** @test **/
    public function testSpare()
    {
        $this->game->roll(5);
        $this->game->roll(5);
        $this->rolls(18, 1);
        $this->assertEquals(29, $this->game->score());
    }

    /** @test **/
    public function testStrike()
    {
        $this->game->roll(10);
        $this->rolls(18, 1);
        $this->assertEquals(30, $this->game->score());
    }

    /** @test **/
    public function testBestGame()
    {
        $this->rolls(12, 10);
        $this->assertEquals(300, $this->game->score());
    }

    private function rolls(int $numberOfRolls, int $numberOfPins): void
    {
        for ($counter = 1; $counter <= $numberOfRolls; $counter++) {
            $this->game->roll($numberOfPins);
        }
    }
}
