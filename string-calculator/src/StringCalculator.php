<?php

class StringCalculator
{
    const MAX_NUMBER_ALLOWED = 1000;

    public function add($numbers)
    {
        $numbers = $this->parseNumbers($numbers);

        return array_reduce($numbers, function($sum, $number)
        {
            $this->guardAgainstNegativeNumbers($number);

            if ($number >= self::MAX_NUMBER_ALLOWED)
                return $sum;

            return $sum += $number;
        }, 0);
    }

    private function parseNumbers($numbers)
    {
        return array_map(
            'intval',
            preg_split('/\s*[,\\\n]\s*/', $numbers)
        );
    }

    private function guardAgainstNegativeNumbers($number)
    {
        if ($number < 0)
        {
            throw new InvalidArgumentException("Negative numbers are not allowed: {$number}");
        }
    }
}
