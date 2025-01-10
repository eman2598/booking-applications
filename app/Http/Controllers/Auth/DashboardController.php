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

        $incomplete_bookings = Booking::where('status', 'free')->count();

        $category = Category::count();
        $events = Event::take(3)->orderBy('created_at', 'desc')->get();
        return view('auth.dashboard', compact('completed_booking', 'incomplete_bookings', 'category', 'events'));
    }
}
