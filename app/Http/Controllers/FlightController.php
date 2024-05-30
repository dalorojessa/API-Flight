<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FlightService;

class FlightController extends Controller
{
    protected $flightService;

    public function __construct(FlightService $flightService)
    {
        $this->flightService = $flightService;
    }

    public function autoComplete(Request $request)
    {
        $query = $request->input('q', 'Philippines');
        $result = $this->flightService->getAutoComplete($query);

        return response()->json($result);
    }

    public function searchOneWayFlight(Request $request)
    {
        $flyingFrom = $request->input('flying_from');
        $flyingTo = $request->input('flying_to');
        $departureDate = $request->input('departure_date');
        $searchType = $request->input('search_type');

        if (!$flyingFrom || !$flyingTo || !$departureDate || !$searchType) {
            return response()->json(['error' => 'Missing required parameters'], 400);
        }

        $result = $this->flightService->searchOneWayFlight($flyingFrom, $flyingTo, $departureDate, $searchType);

        return response()->json($result);
    }
}
