<?php

namespace Matt\RomanNumerals;

interface GeneratorInterface
{
    /**
     * Generate roman numeral for Integer
     *
     * @param integer $integer
     *
     * @return string
     */
    public function generate($integer);

    /**
     * Parse roman numeral to get Integer
     *
     * @param string $romanNumeral
     *
     * @return integer
     */
    public function parse($romanNumeral);
}