<?php
// src/Controller/WeatherController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
# Simplifies Routing
use Symfony\Component\Routing\Annotation\Route;
# Renders HTML
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\WeatherDetails;

class WeatherController extends AbstractController
{
	/**
	* @Route("/weather")
	*
	*/ 

    public function weather()
    {
    	
        $number = random_int(0, 100);
        $a = new WeatherDetails();
        $a->setProviderName('nath');

        echo($a->getCurrentWeather("london")->getProviderName());

        return $this->render('weather\weather.html.twig', [
        	'number' => $number,
        ]);
    }

    function getWeather(Request $request)
    {

    	echo($request->query->get('location'));
    }

    
}