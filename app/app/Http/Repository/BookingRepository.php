<?php

namespace App\Http\Repository;

use App\Http\Dto\UserDTO;
use App\Http\Resources\BookingResource;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class BookingRepository
{
    public function bookTrip(string $tripId): BookingResource
    {
        $booking = new Booking();
        $booking->user_id = auth()->user()->id;
        $booking->trip_id = $tripId;
        $booking->saveOrFail();

        return new BookingResource($booking->with(['user', 'trip'])->where(['id' => $booking->id])->first()->toArray());
    }

}
