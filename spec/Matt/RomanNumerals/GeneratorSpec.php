<?php

namespace spec\Matt\RomanNumerals;

use Matt\RomanNumerals\GeneratorInterface;
use OutOfRangeException;
use PhpSpec\ObjectBehavior;

class GeneratorSpec extends ObjectBehavior
{
    function it_is_a_generator()
    {
        $this->shouldHaveType(GeneratorInterface::class);
    }

    function it_encodes_the_symbols_roman_numerals_are_based_on()
    {
        $this->generate(1)->shouldReturn('I');
        $this->generate(5)->shouldReturn('V');
        $this->generate(10)->shouldReturn('X');
        $this->generate(50)->shouldReturn('L');
        $this->generate(100)->shouldReturn('C');
        $this->generate(500)->shouldReturn('D');
        $this->generate(1000)->shouldReturn('M');
    }

    function it_encodes_two()
    {
        $this->generate(2)->shouldReturn('II');
    }

    function it_encodes_three()
    {
        $this->generate(3)->shouldReturn('III');
    }

    function it_encodes_four()
    {
        $this->generate(4)->shouldReturn('IV');
    }

    function it_encodes_six()
    {
        $this->generate(6)->shouldReturn('VI');
    }

    function it_encodes_nine()
    {
        $this->generate(9)->shouldReturn('IX');
    }

    function it_encodes_eleven()
    {
        $this->generate(11)->shouldReturn('XI');
    }

    function it_encodes_according_to_subtractive_rules()
    {
        $this->generate(90)->shouldReturn('XC');
        $this->generate(40)->shouldReturn('XL');
        $this->generate(900)->shouldReturn('CM');
        $this->generate(400)->shouldReturn('CD');
    }

    function it_encodes_three_thousand_nine_hundred_and_ninety_nine()
    {
        $this->generate(3999)->shouldReturn('MMMCMXCIX');
    }

    function it_only_encodes_values_above_zero()
    {
        $this->shouldThrow(OutOfRangeException::class)->duringGenerate(0);
    }

    function it_only_encodes_values_below_four_thousand()
    {
        $this->shouldThrow(OutOfRangeException::class)->duringGenerate(4000);
    }

    function it_only_encodes_integers()
    {
        $this->shouldThrow(OutOfRangeException::class)->duringGenerate('a');
    }

    function it_decodes_the_symbols_roman_numerals_are_based_on()
    {
        $this->parse('I')->shouldReturn(1);
        $this->parse('V')->shouldReturn(5);
        $this->parse('X')->shouldReturn(10);
        $this->parse('L')->shouldReturn(50);
        $this->parse('C')->shouldReturn(100);
        $this->parse('D')->shouldReturn(500);
        $this->parse('M')->shouldReturn(1000);
    }

    function it_decodes_two()
    {
        $this->parse('II')->shouldReturn(2);
    }

    function it_decodes_three()
    {
        $this->parse('III')->shouldReturn(3);
    }

    function it_decodes_four()
    {
        $this->parse('IV')->shouldReturn(4);
    }

    function it_decodes_six()
    {
        $this->parse('VI')->shouldReturn(6);
    }

    function it_decodes_nine()
    {
        $this->parse('IX')->shouldReturn(9);
    }

    function it_decodes_eleven()
    {
        $this->parse('XI')->shouldReturn(11);
    }

    function it_decodes_according_to_subtractive_rules()
    {
        $this->parse('XC')->shouldReturn(90);
        $this->parse('XL')->shouldReturn(40);
        $this->parse('CM')->shouldReturn(900);
        $this->parse('CD')->shouldReturn(400);
    }

    function it_decodes_three_thousand_nine_hundred_and_ninety_nine()
    {
        $this->parse('MMMCMXCIX')->shouldReturn(3999);
    }
}
