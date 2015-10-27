Feature: Prices created or retrieve using doctrine should be provided with a tax calculator

  @persistListener
  Scenario: When i persist a new PriceIncludingTax it should be provided with a TaxCalculator
    Given I have a PriceIncludingTax with value 1.20
    When I persist it
    Then priceWithTax should be 1.20
    And priceWithoutTax should be 1.00

  @persistListener
  Scenario: When i persist a new PriceExcludingTax it should be provided with a TaxCalculator
    Given I have a PriceExcludingTax with value 1.20
    When I persist it
    Then priceWithTax should be 1.20
    And priceWithoutTax should be 1.00

  @retrieveListener
  Scenario: When i retrieve a PriceExcludingTax it should have been provided with a TaxCalculator
    Given I have a PriceExcludingTax with value 1.20
    And it is persisted
    When I retrieve it from the database
    Then priceWithTax should be 1.20
    And priceWithoutTax should be 1.00

  @retrieveListener
  Scenario: When i retrieve a PriceIncludingTax it should have been provided with a TaxCalculator
    Given I have a PriceIncludingTax with value 1.20
    And it is persisted
    When I retrieve it from the database
    Then priceWithTax should be 1.20
    And priceWithoutTax should be 1.00
