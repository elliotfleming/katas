<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BowlingGameSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('BowlingGame');
    }

    function it_takes_exception_to_invalid_rolls()
    {
        $this->shouldThrow('InvalidArgumentException')->duringRoll(-5);
    }

    function it_scores_a_gutter_game_as_0()
    {
        $this->rollTimes(20, 0);

        $this->score()->shouldBe(0);
    }

    function it_scores_the_sum_of_all_knocked_down_pins_for_a_game()
    {
        $this->rollTimes(20, 1);

        $this->score()->shouldBe(20);
    }

    function it_awards_a_one_roll_bonus_for_every_spare()
    {
        $this->rollSpare();
        $this->roll(5);

        $this->rollTimes(17, 0);

        $this->score()->shouldBe(20);
    }

    function it_awards_a_two_roll_bonus_for_every_strike()
    {
        $this->roll(10);
        $this->roll(7);
        $this->roll(2);

        $this->rollTimes(17, 0);

        $this->score()->shouldBe(28);
    }

    function it_scores_a_perfect_game()
    {
        $this->rollTimes(12, 10);

        $this->score()->shouldBe(300);
    }

    function it_awards_a_one_roll_bonus_for_a_gutter_and_a_ten() {
        $this->roll(0);
        $this->roll(10);
        $this->roll(7);
        $this->roll(2);
        $this->rollTimes(16, 0);
        $this->score()->shouldBe(26);
    }

    function it_should_roll_three_frames() {
        $this->roll(0);
        $this->roll(10);
        $this->roll(7);
        $this->roll(3);
        $this->roll(2);
        $this->roll(3);
        $this->rollTimes(14, 0);
        $this->score()->shouldBe(34);
    }

    private function rollSpare()
    {
        $this->roll(8);
        $this->roll(2);
    }

    private function rollTimes($rolls, $pins)
    {
        for ($i = 0; $i < $rolls; $i++)
        {
            $this->roll($pins);
        }
    }
}
