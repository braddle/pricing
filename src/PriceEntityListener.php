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
     * @param Price $object The model to inject the tax calculator into
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
     * @param Price $object The model to inject the tax calculator into
     *
     * @return void
     */
    public function prePersist(Price $object)
    {
        $this->provideObjectWithTaxCalculator($object);
    }

    /**
     * Cheating. this should have been injected in but this is just an example.
     */
    private function provideObjectWithTaxCalculator(Price $price)
    {
        $price->setTaxCalculator(new TaxCalculator(20));
    }
}
