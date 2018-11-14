<?php

namespace App\Controller;

use App\GoogleApi\WeatherService;
use App\Model\NullWeather;
use App\Validators\DateValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class WeatherController extends AbstractController
{
    public function index($day)
    {
        $validator = new DateValidator($day);
        if (!$validator->validateDateFormat() || !$validator->validateCurrentDate()) { //|| !$validator->validateCurrentDate()
            return new JsonResponse($validator->getError());
        }

        try {
            $fromGoogle = new WeatherService();
            $weather = $fromGoogle->getDay(new \DateTime($day));
        } catch (\Exception $exp) {
            $weather = new NullWeather();
        }

        return $this->render('weather/index.html.twig', [
            'weatherData' => [
                'date'      => $weather->getDate()->format('Y-m-d'),
                'dayTemp'   => $weather->getDayTemp(),
                'nightTemp' => $weather->getNightTemp(),
                'sky'       => $weather->getSky()
            ],
        ]);
    }
}
