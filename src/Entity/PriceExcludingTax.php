<?php

namespace Braddle\Pricing\Entity;

class PriceExcludingTax extends Price
{


    public function getPriceWithoutTax()
    {
        $this->assertPriceCalculate();

        return $this->price;
    }

    public function getPriceWithTax()
    {
        $this->assertPriceCalculate();

        return $this->taxCalculator->addTax($this->price);
    }


}
