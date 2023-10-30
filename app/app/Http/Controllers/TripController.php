<?php

namespace App\Http\Controllers;

use App\Http\Dto\TripDTO;
use App\Http\Dto\UserDTO;
use App\Http\Requests\TripRequest;
use App\Http\Services\TripService;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TripController extends Controller
{
    public function __construct(private readonly TripService $tripService){}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            return new Response(
                $this->tripService->getTrips()
            );
        } catch (\Exception $exception) {
            return new Response(
                ['error' => $exception->getMessage()],
                $exception->getCode()
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TripRequest $request): Response
    {
        try {
            return new Response($this->tripService->saveTrip(
                $this->requestToTripDTO($request)
            ));
        } catch (\Exception $exception) {
            return new Response(
                ['error' => $exception->getMessage()],
                $exception->getCode()
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        return new Response($this->tripService->getTripBySlug($slug));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        //
    }

    private function requestToTripDTO(Request $request): TripDTO
    {
        return new TripDTO(
            $request->get('slug'),
            $request->get('title'),
            $request->get('description'),
            $request->get('start_date'),
            $request->get('end_date'),
            $request->get('location'),
            $request->get('price')
        );
    }
}
