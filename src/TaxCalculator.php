<?php

namespace Braddle\Pricing;

class TaxCalculator
{
    private $taxRate;


    /**
     * TaxCalculator constructor.
     *
     * @param float $taxRate
     */
    public function __construct($taxRate)
    {
        $this->taxRate = $taxRate;
    }

    public function addTax($value)
    {
        $onePerCent = $value / 100;

        $taxAmount = $onePerCent * $this->taxRate;

        $valueWithTax = $value + $taxAmount;

        return $valueWithTax;
    }

    public function removeTax($value)
    {
        $onePerCent = $value / (100 + $this->taxRate);

        $valueWithoutTax = $onePerCent * 100;

        return $valueWithoutTax;
    }
}
