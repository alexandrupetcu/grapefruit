<?php

namespace App\Http\Controllers;

use App\Http\Dto\UserDTO;
use App\Http\Services\BookingService;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookingController extends Controller
{
    public function __construct(private readonly BookingService $bookingService){}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $tripId): Response
    {
        try {
            return new Response($this->bookingService->bookTrip($tripId));
        } catch (\Exception $exception) {
            return new Response(
                ['error' => $exception->getMessage()],
                $exception->getCode()
            );
        }
    }
}
