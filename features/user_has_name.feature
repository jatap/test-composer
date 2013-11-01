Feature: User has name
  In order to start using Behat
  As a manager or developer
  I need to try

  Scenario: Successfully describing user Scenario
    Given there is an User
    When I request his name
    Then I should see Julio