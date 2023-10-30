<?php

namespace App\Http\Services;

use App\Http\Dto\TripDTO;
use App\Http\Repository\TripRepository;
use App\Http\Resources\TripCollection;
use App\Http\Resources\TripResource;

class TripService
{
    public function __construct(
        private readonly TripRepository $tripRepository
    )
    {}

    public function getTrips(): TripCollection
    {
        return $this->tripRepository->getTrips();
    }

    public function saveTrip(TripDTO $tripDTO): TripResource
    {
        return $this->tripRepository->saveTrip($tripDTO);
    }

    public function getTripBySlug(string $slug): TripResource
    {
        return $this->tripRepository->getTripBySlug($slug);
    }
}
