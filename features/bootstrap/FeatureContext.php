<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Braddle\Pricing\Entity\PriceIncludingTax;
use Braddle\Pricing\Entity\Price;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var Price
     */
    private $price;

    /**
     * @var integer
     */
    private $priceId;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $paths     = ["config"];
        $isDevMode = false;

        $dbParams = [
            'driver' => 'pdo_sqlite',
            'path'     => 'pricing.db',
        ];

        $config = Setup::createYAMLMetadataConfiguration($paths, $isDevMode);

        $this->entityManager = EntityManager::create($dbParams, $config);
    }

    /**
     * @Given I have a PriceIncludingTax with value :price
     */
    public function iHaveAPriceIncludingTaxWithValue($price)
    {
        $this->price = new PriceIncludingTax($price);
    }

    /**
     * @Given I have a PriceExcludingTax with value :price
     */
    public function iHaveAPriceexcludingtaxWithValue($price)
    {
        $this->price = new PriceIncludingTax($price);
    }

    /**
     * @Given it is persisted
     */
    public function itIsPersisted()
    {
        $this->iPersistIt();

        $this->priceId = $this->price->getId();

        $this->price = null;

        $this->entityManager->clear();
    }

    /**
     * @When I persist it
     */
    public function iPersistIt()
    {
        $this->entityManager->persist($this->price);
        $this->entityManager->flush();
    }

    /**
     * @When I retrieve it from the database
     */
    public function iRetrieveItFromTheDatabase()
    {
        $this->price = $this->entityManager->find('Braddle\Pricing\Entity\Price', $this->priceId);
    }

    /**
     * @Then priceWithTax should be :expectedValue
     */
    public function priceWithTaxShouldBe($expectedValue)
    {
        $actualValue = $this->price->getpriceWithTax();

        $this->assertEquals($expectedValue, $actualValue);
    }

    /**
     * @Then getpriceWithTax should be :arg1
     */
    public function getpricewithtaxShouldBe($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then priceWithoutTax should be :expectedValue
     */
    public function priceWithoutTaxShouldBe($expectedValue)
    {
        $actualValue = $this->price->getPriceWithoutTax();

        $this->assertEquals($expectedValue, $actualValue);
    }

    /**
     *
     *
     * @param mixed $expectedValue
     * @param mixed $actualValue
     *
     * @throws Exception
     *
     * @return void
     */
    private function assertEquals($expectedValue, $actualValue)
    {
        if ($actualValue != $expectedValue) {
            throw new \Exception('Actual value ' . $expectedValue . ' did not match expected value ' . $expectedValue);
        }
    }
}
