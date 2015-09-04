Feature: Converting roman numerals to integers
  In order to represent roman numerals as integers
  As a developer
  I need an easy way of converting them

  Scenario: Roman numeral is converted to integer
    When I request a roman numeral "MMMCMXCIX"
    Then I should get an integer 3999