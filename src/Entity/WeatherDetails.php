<?php

namespace App\Entity;



class WeatherDetails implements WeatherProvider
{

	private $providerName;
	private $todaysHigh;
	private $todaysLow;
	private $summary;

	#  Gets weather forcast providers Name.
	public function getProviderName():string{

		return $this->providerName;
	}

	public function setProviderName($providerName)
	{

		$this->providerName = $providerName;
	}

	public function getTodaysHigh()
	{
		return $this->todaysHigh;
	}

	public function setTodaysHigh($todaysHigh)
	{
		$this->todaysHigh = $todaysHigh;
	}

	public function getTodaysLow()
	{
		return $this->todaysLow;
	}

	public function setTodaysLow($todaysLow)
	{
		$this->todaysLow = $todaysLow;
	}

	public function getSummary()
	{
		return $this->summary;
	}

	public function setSummary($summary)
	{
		$this->summary = $summary;
	}

	public function getCurrentWeather(string $location): WeatherDetails
	{
		return $this;
	}

}