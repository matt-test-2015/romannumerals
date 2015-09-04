<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Psr\Http\Message\ResponseInterface;

class ApiContext implements Context, SnippetAcceptingContext
{
    /**
     * @var Client $client
     */
    private $client;

    /**
     * @var ResponseInterface $response
     */
    private $response;

    public function __construct($baseUri)
    {
        $this->client = new Client(['base_uri' => $baseUri]);
    }

    /**
     * @When I request a number :integer
     */
    public function iRequestANumber($integer)
    {
        $this->getRequest(sprintf('integers/%d', $integer));
    }

    /**
     * @When I request a roman numeral :romanNumeral
     */
    public function iRequestARomanNumeral($romanNumeral)
    {
        $this->getRequest(sprintf('romannumerals/%s', $romanNumeral));
    }

    private function getRequest($path)
    {
        try {
            $this->response = $this->client->get($path);
        } catch (BadResponseException $e) {
            $this->response = $e->getResponse();
        }
    }

    /**
     * @Then I should get a roman numeral :romanNumeral
     */
    public function iShouldGetARomanNumeral($romanNumeral)
    {
        PHPUnit_Framework_Assert::assertEquals(200, $this->response->getStatusCode());
        $json = json_decode($this->response->getBody()->getContents());
        PHPUnit_Framework_Assert::assertEquals($romanNumeral, $json->data->attributes->roman_numeral);
    }

    /**
     * @Then I should get an integer :integer
     */
    public function iShouldGetAnInteger($integer)
    {
        PHPUnit_Framework_Assert::assertEquals(200, $this->response->getStatusCode());
        $json = json_decode($this->response->getBody()->getContents());
        PHPUnit_Framework_Assert::assertEquals($integer, $json->data->attributes->integer);
    }

    /**
     * @Then I should be presented with an invalid number error
     */
    public function iShouldBePresentedWithAnInvalidNumberError()
    {
        PHPUnit_Framework_Assert::assertEquals(404, $this->response->getStatusCode());
        $json = json_decode($this->response->getBody()->getContents());
        PHPUnit_Framework_Assert::assertObjectHasAttribute('errors', $json);
    }
}
