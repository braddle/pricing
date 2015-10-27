<?php

namespace spec\Braddle\Pricing\Entity;

use Braddle\Pricing\TaxCalculator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PriceExcludingTaxSpec extends ObjectBehavior
{

    function let()
    {
        $this->beConstructedWith(1.0);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Braddle\Pricing\Entity\PriceExcludingTax');
    }

    function it_requires_a_tax_calculator_to_get_a_price_excluding_tax()
    {
        $this->shouldThrow(new \Exception('Tax calculator required.'))->during('getPriceWithoutTax');
    }

    function it_is_able_to_return_its_price_excluding_tax()
    {
        $taxCalculator = new TaxCalculator(20);

        $this->setTaxCalculator($taxCalculator);

        $this->getPriceWithoutTax()->shouldReturn(1.0);
    }

    function it_requires_a_tax_calculator_to_get_a_price_including_tax()
    {
        $this->shouldThrow(new \Exception('Tax calculator required.'))->during('getPriceWithTax');
    }

    function it_is_able_to_return_its_price_including_tax()
    {
        $taxCalculator = new TaxCalculator(20);

        $this->setTaxCalculator($taxCalculator);

        $this->getPriceWithTax()->shouldReturn(1.2);
    }
}
