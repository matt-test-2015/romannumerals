Feature: Converting integers to roman numerals
  In order to represent integers as roman numerals
  As a developer
  I need an easy way of converting them

  Scenario: Integer is converted to roman numeral
    When I request a number 3999
    Then I should get a roman numeral "MMMCMXCIX"

  Scenario: Unsupported integer is rejected
    When I request a number 4000
    Then I should be presented with an invalid number error