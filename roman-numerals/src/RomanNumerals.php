<?php

class RomanNumerals
{
    protected static $lookup = [
        1000 => 'M',
        900  => 'CM',
        500  => 'D',
        400  => 'CD',
        100  => 'C',
        90   => 'XC',
        50   => 'L',
        40   => 'XL',
        10   => 'X',
        9    => 'IX',
        5    => 'V',
        4    => 'IV',
        1    => 'I'
    ];

    /**
     * Good for numbers up to 5000
     */
    public function convert($number)
    {
        $this->guardAgainstInvalidNumber($number);

        $solution = '';

        foreach (static::$lookup as $limit => $glyph)
        {
            while ($number >= $limit)
            {
                $solution .= $glyph;

                $number -= $limit;
            }

            /**
             * Alternative look
             *
             * for (; $number >= $limit; $number -= $limit)
             * {
             *     $solution .= $glyph;
             * }
             */
        }

        return $solution;
    }

    public function guardAgainstInvalidNumber($number)
    {
        if ($number < 1)
        {
            throw new InvalidArgumentException('Number must be > 0.');
        }
    }
}
