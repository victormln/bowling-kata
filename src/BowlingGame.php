<?php

namespace bowling;

final class BowlingGame
{
    const MAX_ROLLS = 21;

    const SPARE = 10;

    const STRIKE = 10;

    /** @var array */
    private $scores = [];

    /** @var int */
    private $actualRoll = 0;

    public function __construct()
    {
        for($counter = 1; $counter <= self::MAX_ROLLS; $counter++) $this->scores[] = 0;
    }

    public function roll($pins)
    {
        $this->scores[$this->actualRoll] += $pins;
        $this->actualRoll++;
    }

    public function score()
    {
        $score = 0;
        $position = 0;
        for($counter = 1; $counter <= 10; $counter++) {
            if($this->isStrike($position)) {
                $score += $this->scores[$position] + $this->scores[$position+1] + $this->scores[$position+2];
                $position += 1;
                continue;
            }
            if($this->isSpark($position)) {
                $score += $this->scores[$position] + $this->scores[$position+1] + $this->scores[$position+2];
                $position += 2;
                continue;
            }
            $score += $this->scores[$position] + $this->scores[$position+1];
            $position += 2;
        }

        return $score;
    }

    /**
     * @param int $position
     * @return bool
     */
    private function isSpark(int $position): bool
    {
        return $this->scores[$position] + $this->scores[$position + 1] === self::SPARE;
    }

    /**
     * @param int $position
     * @return bool
     */
    private function isStrike(int $position): bool
    {
        return $this->scores[$position] === self::STRIKE;
    }
}
