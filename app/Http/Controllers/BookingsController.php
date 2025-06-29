<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingsController extends Controller
{
    public function index()
    {
        $booking=Booking::where('user_id',Auth::id())
        ->with('service')
        ->paginate(10);
        return response()->json($booking);
    }
}
