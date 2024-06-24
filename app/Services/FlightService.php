<?php

// Define the namespace for this service class to organize code
namespace App\Services;

// Import the GuzzleHttp client for making HTTP requests
use GuzzleHttp\Client;

// Define the FlightService class
class FlightService
{
    // Property to hold the GuzzleHttp client instance
    protected $client;
    // Property to hold the API host URL
    protected $apiHost;
    // Property to hold the API key
    protected $apiKey;

    // Constructor method to initialize GuzzleHttp client, API host, and API key
    public function __construct()
    {
        // Initialize a new GuzzleHttp client instance
        $this->client = new Client();
        // Retrieve the API host URL
        $this->apiHost = 'agoda-com.p.rapidapi.com';
        // Retrieve the API key from the env
        $this->apiKey = env('RAPIDAPI_KEY');
    }

    // Method to perform autoComplete search for flight destinations
    public function getAutoComplete($query)
    {
        // Query parameters for autoComplete search
        $response = $this->client->request('GET', "https://{$this->apiHost}/flights/auto-complete", [
            'query' => ['q' => $query],
            'headers' => [
                // Set API host header
                'X-RapidAPI-Host' => $this->apiHost,
                // Set API key header
                'X-RapidAPI-Key' => $this->apiKey,
            ],
        ]);

        // Decode JSON response and return as array
        return json_decode($response->getBody(), true);
    }

    // Method to searchOneWayFlight/one-way flights based on specified attributes
    public function searchOneWayFlight($flyingFrom, $flyingTo, $departureDate, $searchType)
    {
        // Query parameters
        $response = $this->client->request('GET', "https://{$this->apiHost}/flights/one-way/search", [
            'query' => [
                // Origin airport or city
                'flying_from' => $flyingFrom,
                // Destination airport or city
                'flying_to' => $flyingTo,
                // Date of departure
                'departure_date' => $departureDate,
                // Type of search
                'search_type' => $searchType,
            ],
            'headers' => [
                // Set API host header
                'X-RapidAPI-Host' => $this->apiHost,
                // Set API key header
                'X-RapidAPI-Key' => $this->apiKey,
            ],
        ]);

        // Decode JSON response and return as array
        return json_decode($response->getBody(), true);
    }
}
