<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    private $_user;
    private $_output;

    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }

    // User --------------------------------------------------------------------

    /**
     * @Given /^there is an User$/
     */
    public function thereIsAnUser()
    {
        $this->_user = new User\Base('Julio');
    }

    /**
     * @When /^I request his name$/
     */
    public function iRequestHisName()
    {
        $this->_user->getName();
    }

    /**
     * @Then /^I should see Julio$/
     */
    public function iShouldSeeJulio()
    {
        if ('Julio' !== $this->_user->getName()) {
            throw new Exception(
                "Actual user name is:\n" . $this->_user->getName()
            );
        }
    }

    // File structure ----------------------------------------------------------

    /**
     * @Given /^I am in "([^"]*)" directory$/
     */
    public function iAmInDirectory($dir)
    {
        if ( ! file_exists("/Users/julioantuneztarin/Sites/$dir")) {
            mkdir($dir);
        }
        chdir(realpath("/Users/julioantuneztarin/Sites/$dir"));
    }

    /**
     * @When /^I run "([^"]*)" to "([^"]*)" directory$/
     */
    public function iRunToDirectory($command, $dir)
    {
        chdir($dir);
        exec($command, $output);
        $this->_output = trim(implode("\n", $output));
    }

    /**
     * @Then /^I should get:$/
     */
    public function iShouldGet(PyStringNode $string)
    {
        assertEquals($string->getRaw(), $this->_output);
//        if ((string) $string !== $this->_output) {
//            throw new Exception(
//                "Actual output is:\n" . $this->_output
//            );
//        }
    }
}
