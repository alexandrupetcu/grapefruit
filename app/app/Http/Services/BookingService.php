<?php

namespace App\Http\Services;

use App\Exceptions\DatabaseException;
use App\Exceptions\InvalidCredentials;
use App\Http\Dto\UserDTO;
use App\Http\Repository\BookingRepository;
use App\Http\Repository\TripRepository;
use App\Http\Repository\UserRepository;
use App\Http\Resources\BookingResource;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class BookingService
{
    public function __construct(
        private readonly BookingRepository $bookingRepository,
        private readonly TripRepository $tripRepository
    )
    {}

    public function bookTrip(string $tripId): BookingResource
    {
        if(!$this->tripRepository->getTripById($tripId)) {
            throw new \Exception('Invalid trip', 400);
        }

        return $this->bookingRepository->bookTrip($tripId);
    }


}
