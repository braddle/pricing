<?php

namespace Braddle\Pricing\Entity;

class PriceIncludingTax extends Price
{
    public function getpriceWithTax()
    {
        $this->assertPriceCalculate();

        return $this->price;
    }

    public function getPriceWithoutTax()
    {
        $this->assertPriceCalculate();

        return $this->taxCalculator->removeTax($this->price);
    }


}
