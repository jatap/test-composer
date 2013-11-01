Feature: bin directory must exists
  In order to check if bin directory exists
  As a UNIX user
  I need to be able to list the current directory's contents

  Scenario: List behat file
    Given I am in "test_composer.dev" directory
    When I run "ls" to "bin" directory
    Then I should get:
      """
      behat
      phpunit
      """