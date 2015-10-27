<?php
namespace Braddle\Pricing\Entity;

use Braddle\Pricing\TaxCalculator;

/**
 * Class Price
 *
 * @package Braddle\Pricing\Entity
 */
abstract class Price
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var TaxCalculator
     */
    protected $taxCalculator;


    /**
     * Price constructor.
     *
     * @param float $price
     */
    public function __construct($price)
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $taxCalculator
     */
    public function setTaxCalculator(TaxCalculator $taxCalculator)
    {
        $this->taxCalculator = $taxCalculator;
    }

    /**
     *
     *
     * @throws \Exception
     *
     * @return void
     */
    protected function assertPriceCalculate()
    {
        if (!$this->taxCalculator instanceof TaxCalculator) {
            throw new \Exception('Tax calculator required.');
        }
    }

    /**
     *
     *
     * @return float
     */
    abstract public function getpriceWithTax();

    /**
     *
     *
     * @return float
     */
    abstract public function getPriceWithoutTax();
}
