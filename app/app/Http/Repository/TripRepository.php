<?php

namespace App\Http\Repository;

use App\Http\Dto\TripDTO;
use App\Http\Resources\TripCollection;
use App\Http\Resources\TripResource;
use App\Models\Trip;

class TripRepository
{
    public function getTrips(): TripCollection
    {
        return new TripCollection(Trip::sort()->filter()->get());
    }

    public function saveTrip(TripDTO $tripDTO): TripResource
    {
        $trip = new Trip;
        $trip->slug = $tripDTO->getSlug();
        $trip->title = $tripDTO->getTitle();
        $trip->description = $tripDTO->getDescription();
        $trip->start_date = $tripDTO->getStartDate();
        $trip->end_date = $tripDTO->getEndDate();
        $trip->location = $tripDTO->getLocation();
        $trip->price = $tripDTO->getPrice();
        $trip->saveOrFail();

        return new TripResource($trip);
    }

    public function getTripBySlug(string $slug): TripResource
    {
        return new TripResource(Trip::where(['slug' => $slug])->first());
    }

    public function getTripById(string $tripId): ?Trip
    {
        return Trip::where(['id' => $tripId])->first();
    }
}
