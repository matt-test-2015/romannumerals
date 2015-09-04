<?php

namespace Matt\RomanNumerals;

use OutOfRangeException;

class Generator implements GeneratorInterface
{
    /*
     * @var array $romanHashMap
     */
    private $romanHashMap
        = [
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

    public function generate($integer)
    {
        $this->validateIntegerInSupportedRange($integer);

        $romanNumeral = '';

        foreach ($this->romanHashMap as $key => $symbol) {
            while ($integer >= $key) {
                $romanNumeral .= $symbol;
                $integer -= $key;
            }
        }

        return $romanNumeral;
    }

    public function parse($romanNumeral)
    {
        $integer = 0;

        foreach ($this->romanHashMap as $key => $symbol) {
            while (0 === strpos($romanNumeral, $symbol)) {
                $integer += $key;
                $romanNumeral = substr($romanNumeral, strlen($symbol));
            }
        }

        return $integer;
    }

    /**
     * Validate integer is in the supported range
     *
     * @param $integer
     *
     * @throws OutOfRangeException
     */
    private function validateIntegerInSupportedRange($integer)
    {
        if ( ! is_integer($integer) || 0 === $integer || 3999 < $integer) {
            throw new OutOfRangeException('only integers between 1 and 3999 are supported');
        }
    }
}
