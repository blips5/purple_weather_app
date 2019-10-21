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
class WeatherController extends AbstractController
{
    private $ukCities = array( "bath", "birmingham", "bradford", "brighton",
            "Bristol", "Cambridge", "Canterbury", "Carlisle", "Chelmsford", "Chester",
            "chichester", "coventry", "derby", "durham", "ely", "exeter",
            "gloucester", "hereford", "kingston-upon-hull", "lancaster", "leeds",
            "leicester", "lichfield", "lincoln", "liverpool", "london", "manchester",
            "newcastle", "norwich", "nottingham", "oxford", "peterborough", "plymouth",
            "portsmouth", "preston", "ripon", "salford", "salisbury", "sheffield",
            "southampton", "st albans", "stoke-on-trent", "sunderland", "Truro",
            "wakefield", "wells", "westminster", "winchester", "wolverhampton",
            "worcester", "york", "aberdeen", "dundee", "edinburgh", "glasgow",
            "inverness", "perth", "stirling", "cardiff", "caerdydd", "swansea",
            "abertawe", "newport", "casnewyddin", "bangor",
        );
    /**
    * @Route("/weather")
    * @method ("POST", "GET")
    */ 
    public function weather(Request $request)
    {
        $weatherDetailsArray = array();
        $weatherDetails;
        $location = 'Manchester';
        $errorMsg = "";
        if($request->isMethod('POST'))
        {
            $location = $request->request->get('location');
            # Check if location is in UK
            if(!in_array(strtolower($location), $this->ukCities))
            {
                $errorMsg = "Not a UK City try again";
                $location = 'Manchester';
            }
        }
        for($i = 0; $i < 5; $i++)
        {
            $weatherDetails = new WeatherDetails();
            $weatherDetails->getCurrentWeather($location);
            array_push($weatherDetailsArray, $weatherDetails);
        }

        #$a->setProviderName('nath');
        return $this->render('weather\weather.html.twig', [
            'location' => ucwords($location),
            'weatherDetails' => $weatherDetailsArray,
            'errorMsg' => $errorMsg,
        ]);

    }
    

}

