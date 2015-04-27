<?php

class BowlingGame
{
    const FRAMES_PER_GAME = 10;

    private $rolls = [];

    public function roll($pins)
    {
        $this->guardAgainstInvalidRoll($pins);

        $this->rolls[] = $pins;
    }

    public function score()
    {
        $score = 0;
        $roll  = 0;

        for ($frame = 1; $frame <= self::FRAMES_PER_GAME; $frame++)
        {
            if ($this->isStrike($roll))
            {
                $score += 10 + $this->strikeBones($roll);
                $roll++;
            }
            elseif ($this->isSpare($roll))
            {
                $score += 10 + $this->spareBonus($roll);
                $roll += 2;
            }
            else
            {
                $score += $this->getFrameScore($roll);
                $roll += 2;
            }
        }

        return $score;
    }

    private function isSpare($roll)
    {
        return $this->rolls[$roll] + $this->rolls[$roll + 1] === 10;
    }

    private function spareBonus($roll)
    {
        return $this->rolls[$roll + 2];
    }

    private function isStrike($roll)
    {
        return $this->rolls[$roll] === 10;
    }

    private function strikeBones($roll)
    {
        return $this->rolls[$roll + 1] + $this->rolls[$roll + 2];
    }

    private function getFrameScore($roll)
    {
        return $this->rolls[$roll] + $this->rolls[$roll + 1];
    }

    private function guardAgainstInvalidRoll($pins)
    {
        if ($pins < 0 || $pins > 10)
        {
            throw new InvalidArgumentException('Must be between 0 and 10.');
        }
    }
}
