<?php

namespace App\Entity;
/**
 * Interface WeatherProvider
 *
 * Defines a 'WeatherProvider' responsible for obtaining weather
information from a particular source, i.e. BBC Weather
 *
 * @package App\Repository
 */
interface WeatherProvider
{
 /**
 * Get the name of the provider, i.e. 'BBC Weather'
 *
 * @return string
 */
 public function getProviderName(): string;
 /**
 * Retrieve the current weather summary for a given location
 *
 * @param string $location The name of a UK based location, i.e.
'Manchester' or 'London'
 *
 * @return WeatherDetails The value object containing the weather
details
 */
 public function getCurrentWeather(string $location): WeatherDetails;
}
