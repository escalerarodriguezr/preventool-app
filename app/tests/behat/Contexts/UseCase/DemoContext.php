<?php

namespace Contexts\UseCase;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class DemoContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I am a user with administrator role
     */
    public function iAmAUserWithAdministratorRole()
    {
        throw new PendingException();
    }

    /**
     * @Given I have the following data of a product
     */
    public function iHaveTheFollowingDataOfAProduct(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @When I try to register a product
     */
    public function iTryToRegisterAProduct()
    {
        throw new PendingException();
    }

    /**
     * @Then The product is registered in the system
     */
    public function theProductIsRegisteredInTheSystem()
    {
        throw new PendingException();
    }
}
