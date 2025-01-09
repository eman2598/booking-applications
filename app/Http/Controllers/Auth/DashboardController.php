<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function openDashboardPage()
    {
        $completed_booking = Booking::where(function ($query) {
            $query->where('status', 'paid')
                ->orWhere('status', 'free');
        })->count();

        $incomplete_bookings_query = Booking::whereIn('status', ['unpaid', 'free']);

        // Log the raw SQL query and the bindings
        \Illuminate\Support\Facades\Log::info('Incomplete bookings query: ' . $incomplete_bookings_query->toSql());
        \Illuminate\Support\Facades\Log::info('Incomplete bookings bindings: ' . json_encode($incomplete_bookings_query->getBindings()));

        // Count the incomplete bookings
        $incomplete_bookings_count = $incomplete_bookings_query->count();


        $category = Category::count();
        $events = Event::take(3)->orderBy('created_at', 'desc')->get();
        return view('auth.dashboard', compact('completed_booking', 'incomplete_bookings_count', 'category', 'events'));
    }
}
