<?php

namespace spec\Braddle\Pricing;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TaxCalculatorSpec extends ObjectBehavior
{

    function let()
    {
        $this->beConstructedWith(20);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Braddle\Pricing\TaxCalculator');
    }

    function it_is_able_to_add_tax_to_a_value()
    {
        $this->addTax(1)->shouldReturn(1.2);
    }

    function it_is_able_to_remove_tax_from_a_value()
    {
        $this->removeTax(1.2)->shouldReturn((float) 1);
    }
}
