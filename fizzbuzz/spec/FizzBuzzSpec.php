<?php namespace spec\FizzBuzz;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FizzBuzzSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('FizzBuzz\FizzBuzz');
    }

    function it_translates_1_to_1()
    {
        $this->translate(1)->shouldBe(1);
    }

    function it_translates_2_to_2()
    {
        $this->translate(2)->shouldBe(2);
    }

    function it_translates_3_to_fizz()
    {
        $this->translate(3)->shouldBe('fizz');
    }

    function it_translates_5_to_buzz()
    {
        $this->translate(5)->shouldBe('buzz');
    }

    function it_translates_15_to_fizzbuzz()
    {
        $this->translate(15)->shouldBe('fizzbuzz');
    }

    function it_translates_a_sequence_of_numbers_for_fizzbuzz()
    {
        $this->translateUpTo(5)->shouldBe([1, 2, 'fizz', 4, 'buzz']);
    }

    function it_takes_exception_to_0()
    {
        $this->shouldThrow('InvalidArgumentException')->duringTranslate(0);
    }

    function it_takes_exception_to_negative_numbers()
    {
        $this->shouldThrow('InvalidArgumentException')->duringTranslate(-1);
    }
}
