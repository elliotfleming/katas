<?php namespace Tennis;

class Match
{
    private $player1;

    private $player2;

    private $lookup = [
        0 => 'Love',
        1 => 'Fifteen',
        2 => 'Thirty',
        3 => 'Forty'
    ];

    public function __construct(Player $player1, Player $player2)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    public function score()
    {
        if ($this->won())
        {
            return 'Win for ' . $this->winner()->name;
        }

        if ($this->advantage())
        {
            return 'Advantage ' . $this->leader()->name;
        }

        if ($this->deuce())
        {
            return 'Deuce';
        }

        return $this->generalScore();
    }

    private function generalScore()
    {
        $score = $this->lookup[$this->player1->points] . '-';

        return $score .= $this->tied()
            ? 'All'
            : $this->lookup[$this->player2->points];
    }

    private function tied()
    {
        return $this->player1->points === $this->player2->points;
    }

    private function deuce()
    {
        return $this->player1->points + $this->player2->points >= 6 && $this->tied();
    }

    private function advantage()
    {
        return $this->hasEnoughPointsToBeWon() && $this->hasALeaderByOne();
    }

    private function hasALeaderByOne()
    {
        return abs($this->player1->points - $this->player2->points) === 1;
    }

    private function hasALeaderByAtLeastTwo()
    {
        return abs($this->player1->points - $this->player2->points) >= 2;
    }

    private function hasEnoughPointsToBeWon()
    {
        return max([$this->player1->points, $this->player2->points]) >= 4;
    }

    private function won()
    {
        return $this->hasEnoughPointsToBeWon() && $this->hasALeaderByAtLeastTwo();
    }

    private function winner()
    {
        return $this->leader();
    }

    private function leader()
    {
        return $this->player1->points > $this->player2->points
            ? $this->player1
            : $this->player2;
    }
}
