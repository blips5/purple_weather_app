<?php

namespace App\Entity;

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
	public function __construct($providerName, $todaysHigh, $todaysLow, $summary)
	{
		$this->providerName = $providerName;
		$this->todaysHigh = $todaysHigh;
		$this->todaysLow = $todaysLow;
		$this->summary = $summary;
	}
	/**
	*  Gets weather forcast providers Name.
	*  @return String 
	*/
	public function getProviderName():string
	{

		return $this->providerName;
	}

	/**
	*  Sets name of today's weather forcast provider.
	*  @param String $providerName 
	*/
	public function setProviderName($providerName)
	{

		$this->providerName = $providerName;
		return $this;
	}
    
    /**
	*  Gets today's highest temperature. i.e. 9C/50F
	*  @return String 
	*/
	public function getTodaysHigh():string
	{
		return $this->todaysHigh;
	}

	/**
	*  Sets today's highest temperature.
	*  @param String $todaysHigh 
	*/
	public function setTodaysHigh($todaysHigh)
	{
		$this->todaysHigh = $todaysHigh;
		return $this;
	}

    /**
	*  Gets today's lowest temperature. i.e. 5C/41F
	*  @return String 
	*/
	public function getTodaysLow():string
	{
		return $this->todaysLow;
	}

	/**
	*  Sets today's lowest temperature.
	*  @param String $todaysLow 
	*/
	public function setTodaysLow($todaysLow)
	{
		$this->todaysLow = $todaysLow;
		return $this;
	}
	/**
	*  Gets today's summary. i.e. Rain and spells
	*  @return String 
	*/
	public function getSummary()
	{
		return $this->summary;
	}
	/**
	*  Sets today's summary.
	*  @param String $summary 
	*/
	public function setSummary($summary)
	{
		$this->summary = $summary;
		return $this;
	}

	/**
	* Retrieve the current weather summary for a given location
	*
	* @param string $location The name of a UK based location, i.e.
	'Manchester' or 'London'
	*
	* @return WeatherDetails The value object containing the weather
	details
	 */
	public function getCurrentWeather(string $location): WeatherDetails
	{
		return $this;
	}

}