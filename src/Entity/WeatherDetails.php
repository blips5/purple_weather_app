<?php

namespace App\Entity;

use Symfony\Component\HttpClient\HttpClient;
/**
*
*  Class WeatherDetails 
*  Provides a WeatherDetails Object to hold a Weather
*  providers data, i.e. BBC weather, 9C/50F, 5C/41F, Rain with spells
*/

class WeatherDetails implements WeatherProvider
{

	private $providerName;
	private $todaysHigh;
	private $todaysLow;
	private $summary;

	/**
	*
	* Constructor for WeatherDetails
	*/
	public function __construct()
	{
		$this->providerName = "";
		$this->todaysHigh = "";
		$this->todaysLow = "";
		$this->summary = "";
	}

	/**
	*  Gets weather forcast providers Name.
	*  @return String 
	*/
	public function getProviderName(): string
	{

		return $this->providerName;
	}

	/**
	*  Sets name of today's weather forcast provider.
	*  @param String $providerName 
	*/
	public function setProviderName($providerName): string
	{

		$this->providerName = $providerName;
		return $this;
	}
    
    /**
	*  Gets today's highest temperature. i.e. 9C/50F
	*  @return String 
	*/
	public function getTodaysHigh(): string
	{
		return $this->todaysHigh;
	}

	/**
	*  Sets today's highest temperature.
	*  @param String $todaysHigh 
	*/
	public function setTodaysHigh($todaysHigh): string
	{
		$this->todaysHigh = $todaysHigh;
		return $this;
	}

    /**
	*  Gets today's lowest temperature. i.e. 5C/41F
	*  @return String 
	*/
	public function getTodaysLow(): string
	{
		return $this->todaysLow;
	}

	/**
	*  Sets today's lowest temperature.
	*  @param String $todaysLow 
	*/
	public function setTodaysLow($todaysLow): string
	{
		$this->todaysLow = $todaysLow;
		return $this;
	}
	/**
	*  Gets today's summary. i.e. Rain and spells
	*  @return String 
	*/
	public function getSummary(): string
	{
		return $this->summary;
	}
	/**
	*  Sets today's summary.
	*  @param String $summary 
	*/
	public function setSummary($summary): string
	{
		$this->summary = $summary;
		return $this;
	}

	/**
	* Retrieve the current weather summary for a given location uses openweathermap.org SOAP api
	*
	* @param string $location The name of a UK based location, i.e.
	'Manchester' or 'London'
	*
	* @return WeatherDetails The value object containing the weather
	details
	 */
	public function getCurrentWeather(string $location): WeatherDetails
	{
		
    	$this->openWeatherApi($location); 

		return $this;
	}

	/**
	* Helper method
	* Converts kelvins to celcius
	* @param stirng $kelvins 
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
	* @param stirng $kelvins 
	* @return string
	*/
	public function kelvinsToFahrenheit($kelvins): string
	{
		$Fahrenheit = $kelvins * 9/5 - 459.67;
		return round($Fahrenheit);
	}

	/**
	* Calls openwaether.org SAOP api
	* @param string $location
	*/
	private function openWeatherApi($location): WeatherDetails
	{
		$httpClient = HttpClient::create();

		$providerName = 'openWeather.org';
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

        $lowestTemp = $content['main'];
        $lowestTemp = $tempDetails['temp_min'];

        $this->providerName = $providerName;
		$this->todaysHigh = $this->kelvinsToCelcius($highestTemp) . "C" . addslashes("/") . $this->kelvinsToFahrenheit($highestTemp) . "F";
		$this->todaysLow = $this->kelvinsToCelcius($lowestTemp) . "C" . addslashes("/") . $this->kelvinsToFahrenheit($lowestTemp) . "F";
		$this->summary = $summary;

        return $this;
	}

}