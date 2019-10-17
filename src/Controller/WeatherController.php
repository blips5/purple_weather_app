<?php
// src/Controller/WeatherController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
#  Annotation simplifies Routing
use Symfony\Component\Routing\Annotation\Route;
# Renders HTML
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\WeatherDetails;

class WeatherController extends AbstractController
{
	/**
	* @Route("/weather")
	* @method ("post")
	*/ 

    public function weather(Request $request)
    {
    	#echo($request->request->get('location'));
    	$location = $request->request->get('location');

        $a = new WeatherDetails('BBC Weather', addslashes('9C/50F'), addslashes('5C/41F'), 'Rain and spells');
        #$a->setProviderName('nath');

        #echo($a->getCurrentWeather('location')->getProviderName());

        return $this->render('weather\weather.html.twig', [
        	'providerName' => $a->getProviderName(),
        	'todaysHigh' => $a->getTodaysHigh(),
        	'todaysLow' => $a->getTodaysLow(),
        	'summary' => $a->getSummary(),
        ]);
    }   
}