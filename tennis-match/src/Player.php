<?php namespace Tennis;

class Player
{
    public $name;

    public $points;

    public function __construct($name, $points = 0)
    {
        $this->name   = $name;
        $this->points = $points;
    }

    public function scores($points)
    {
        $this->points += $points;
    }
}
