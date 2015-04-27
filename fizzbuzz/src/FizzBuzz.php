<?php namespace FizzBuzz;

use \InvalidArgumentException;

class FizzBuzz
{
    public function translate($number)
    {
        $this->guardAgainstInvalidNumbers($number);

        if ($number % 15 === 0) return 'fizzbuzz';
        if ($number % 3  === 0) return 'fizz';
        if ($number % 5  === 0) return 'buzz';

        return $number;
    }

    public function translateUpTo($number)
    {
        return array_map(function($i) {
            return $this->translate($i);
        }, range(1, $number));
    }

    private function guardAgainstInvalidNumbers($number)
    {
        if ($number < 1)
        {
            throw new InvalidArgumentException;
        }
    }
}
