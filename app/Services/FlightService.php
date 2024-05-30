<?php

namespace App\Services;

use GuzzleHttp\Client;

class FlightService
{
    protected $client;
    protected $apiHost;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiHost = 'agoda-com.p.rapidapi.com';
        $this->apiKey = env('RAPIDAPI_KEY');
    }

    public function getAutoComplete($query)
    {
        $response = $this->client->request('GET', "https://{$this->apiHost}/flights/auto-complete", [
            'query' => ['q' => $query],
            'headers' => [
                'X-RapidAPI-Host' => $this->apiHost,
                'X-RapidAPI-Key' => $this->apiKey,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    public function searchOneWayFlight($flyingFrom, $flyingTo, $departureDate, $searchType)
    {
        $response = $this->client->request('GET', "https://{$this->apiHost}/flights/one-way/search", [
            'query' => [
                'flying_from' => $flyingFrom,
                'flying_to' => $flyingTo,
                'departure_date' => $departureDate,
                'search_type' => $searchType,
            ],
            'headers' => [
                'X-RapidAPI-Host' => $this->apiHost,
                'X-RapidAPI-Key' => $this->apiKey,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
