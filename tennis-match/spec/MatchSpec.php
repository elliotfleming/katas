<?php

namespace spec\Tennis;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Tennis\Player;

class MatchSpec extends ObjectBehavior
{
    private $elliot;

    private $erin;

    function let()
    {
        $this->elliot = new Player('Elliot Fleming');
        $this->erin   = new Player('Erin Fleming');

        $this->beConstructedWith($this->erin, $this->elliot);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Tennis\Match');
    }

    function it_scores_a_scoreless_game()
    {
        $this->score()->shouldReturn('Love-All');
    }

    function it_scores_a_1_0_game()
    {
        $this->erin->scores(2);

        $this->score()->shouldReturn('Thirty-Love');
    }

    function it_scores_a_2_0_game()
    {
        $this->erin->scores(2);

        $this->score()->shouldReturn('Thirty-Love');
    }

    function it_scores_a_3_0_game()
    {
        $this->erin->scores(3);

        $this->score()->shouldReturn('Forty-Love');
    }

    function it_scores_a_4_0_game()
    {
        $this->erin->scores(4);

        $this->score()->shouldReturn('Win for Erin Fleming');
    }

    function it_scores_a_0_4_game()
    {
        $this->elliot->scores(4);

        $this->score()->shouldReturn('Win for Elliot Fleming');
    }

    function it_scores_a_4_3_game()
    {
        $this->erin->scores(4);
        $this->elliot->scores(3);

        $this->score()->shouldReturn('Advantage Erin Fleming');
    }

    function it_scores_a_3_4_game()
    {
        $this->erin->scores(3);
        $this->elliot->scores(4);

        $this->score()->shouldReturn('Advantage Elliot Fleming');
    }

    function it_scores_a_3_3_game()
    {
        $this->inDeuce(3);

        $this->score()->shouldReturn('Deuce');
    }

    function it_scores_a_8_8_game()
    {
        $this->inDeuce(8);

        $this->score()->shouldReturn('Deuce');
    }

    function it_scores_a_9_8_game()
    {
        $this->erin->scores(9);
        $this->elliot->scores(8);

        $this->score()->shouldReturn('Advantage Erin Fleming');
    }

    function it_scores_a_10_8_game()
    {
        $this->erin->scores(10);
        $this->elliot->scores(8);

        $this->score()->shouldReturn('Win for Erin Fleming');
    }

    private function inDeuce($points)
    {
        $this->erin->scores($points);
        $this->elliot->scores($points);
    }
}
