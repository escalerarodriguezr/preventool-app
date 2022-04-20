Feature: Create product when needed
  As Admin User
  I want to register a product
  In order to have products for our customers

  Scenario: Register a new product in the system
    Given I am a user with administrator role
    And I have the following data of a product
      | id | name | price |
      | 1 | Martillo | 125 |
    When I try to register a product
    Then The product is registered in the system