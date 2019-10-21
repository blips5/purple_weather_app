<?php

namespace App\Controller;

use Symfony\Component\HttpClient\HttpClient;

use App\Entity\WeatherDetails;

class WeatherApi extends WeatherController
{

	/**
    * Calls openweathermap.org SOAP api
    * @param string $location
    */
    private function openWeatherApi($location): WeatherDetails
    {
        $httpClient = HttpClient::create();

        $providerName = 'openweathermap.org';
        $location = $location;
        $api = 'https://api.openweathermap.org/data/2.5/weather?q=' . $location . ',uk&APPID=e043bc102337e2b03c7baf563b822850';
        
        $response = $httpClient->request('GET', $api);
        $statusCode = $response->getStatusCode();
        $content = $response->getContent();
        $content = $response->toArray();
        $weather = $content['weather'];
        $weather = $weather[0];

        $summary = $weather['description'];

        $tempDetails = $content['main'];

        $highestTemp = $tempDetails['temp_max'];
        $lowestTemp = $tempDetails['temp_min'];

        $this->providerName = $providerName;
        $this->todaysHigh = $this->kelvinsToCelcius($highestTemp) . "C" . addslashes("/") . $this->kelvinsToFahrenheit($highestTemp) . "F";
        $this->todaysLow = $this->kelvinsToCelcius($lowestTemp) . "C" . addslashes("/") . $this->kelvinsToFahrenheit($lowestTemp) . "F";
        $this->summary = $summary;
        return $this;
    }

    /**
    * Helper method
    * Converts kelvins to celcius
    * @param string $kelvins 
    * @return string
    */
    public function kelvinsToCelcius($kelvins): string
    {
        $celcius = $kelvins - 273.15;
        return round($celcius);
    }

    /**
    * Helper method
    * Converts kelvins to fahrenheit
    * @param string $kelvins 
    * @return string
    */
    public function kelvinsToFahrenheit($kelvins): string
    {
        $Fahrenheit = $kelvins * 9/5 - 459.67;
        return round($Fahrenheit);
    }

}

