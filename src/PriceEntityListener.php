<?php
namespace Braddle\Pricing;

use Braddle\Pricing\Entity\Price;

/**
 * Class PriceEntityListener
 *
 * @package Braddle\Pricing
 */
class PriceEntityListener
{
    /**
     * Fired after an object has been retrieved and initialised by doctrine, before being returned
     *
     * @param PricingConfigAware $object The model to inject the price config into
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @return void
     */
    public function postLoad(Price $object)
    {
        $this->provideObjectWithTaxCalculator($object);
    }
    /**
     * Fired before an object is about to be saved by doctrine
     *
     * @param PricingConfigAware $object The model to inject the price config into
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @return void
     */
    public function prePersist(Price $object)
    {
        $this->provideObjectWithTaxCalculator($object);
    }

    private function provideObjectWithTaxCalculator(Price $price)
    {
        $price->setTaxCalculator(new TaxCalculator(20));
    }
}
