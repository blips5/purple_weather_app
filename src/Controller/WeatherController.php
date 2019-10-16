<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
# Simplifies Routing
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WeatherController extends AbstractController
{
	/**
	* @Route("/weather")
	*
	*/ 

    public function weather()
    {
        $number = random_int(0, 100);

        return $this->render('weather\weather.html.twig', [
        	'number' => $number,
        ]);
    }
}