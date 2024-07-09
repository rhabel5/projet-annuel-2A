<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;

class ApiReservationController extends Controller
{
    public function getUserReservations($userId)
    {
        $reservations = Reservation::where('user_id', $userId)->get();
        return response()->json($reservations);
    }

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
}
