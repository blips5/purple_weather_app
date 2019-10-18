<?php
// src/Controller/WeatherController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
#  for HTTP requests
use Symfony\Component\HttpClient\HttpClient;
#  Annotation simplifies Routing
use Symfony\Component\Routing\Annotation\Route;
# Renders HTML
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\WeatherDetails;
use App\Controller\WeatherHelpers;
class WeatherController extends AbstractController
{
	/**
	* @Route("/weather")
	* @method ("POST", "GET")
	*/ 
    public function weather(Request $request)
    {

    	$location = 'Manchester';
    	if($request->isMethod('POST'))
    	{
    		
			$location = $request->request->get('location');
		}
		$a = new WeatherDetails();
		$a->getCurrentWeather($location);
	    #$a->setProviderName('nath');
        return $this->render('weather\weather.html.twig', [
        	'location' => ucwords($location),
        	'providerName' => $a->getProviderName(),
        	'todaysHigh' => $a->getTodaysHigh(),
        	'todaysLow' => $a->getTodaysLow(),
        	'summary' => $a->getSummary(),
        ]);

    }
    
}

