<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use \InvalidArgumentException;

class StringCalculatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('StringCalculator');
    }

    function it_translates_an_empty_string_into_0()
    {
        $this->add('')->shouldEqual(0);
    }

    function it_finds_the_sum_of_one_number()
    {
        $this->add('5')->shouldEqual(5);
    }

    function it_finds_the_sum_of_two_numbers()
    {
        $this->add('1,2')->shouldEqual(3);
    }

    function it_finds_the_sum_of_any_amount_of_numbers()
    {
        $this->add('1,2,3,4,5')->shouldEqual(15);
    }

    function it_takes_exception_to_negative_numbers()
    {
        $this
            ->shouldThrow(new InvalidArgumentException('Negative numbers are not allowed: -2'))
            ->duringAdd('3,-2');
    }

    function it_ignores_numbers_greater_than_or_equal_to_1000()
    {
        $this->add('1,1000')->shouldEqual(1);
    }

    function it_allows_for_newline_delimiters()
    {
        $this->add('2,2\n2')->shouldEqual(7);
    }
}
