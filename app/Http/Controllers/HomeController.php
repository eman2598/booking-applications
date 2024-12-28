<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;

class HomeController extends Controller
{
    public function openHomePage()
    {
        $events = Event::with(['category'])->get();
        return view('site.index', compact('events'));
    }

    public function openEventsDetailsPage($id)
    {
        $event = Event::findOrFail($id);
        return view('site.details', compact('event'));
    }

    public function checkout()
    {
        $userId = auth()->id();
        $eventId = request()->event_id;

        $event = Event::findOrFail($eventId);

        try {
            Booking::create([
                'user_id' => $userId,
                'events_id' => $eventId,
            ]);

            return to_route('site.thanks')->with('success_msg', 'Your Booking Confirmed');
        } catch (\Exception $ex) {
            return back()->with('booking_failed', 'Your booking is failed, please try again');
        }
    }

    public function openThankuPage()
    {
        return view('site.thanku');
    }

    public function openCancelPage()
    {
        return view('site.cancel');
    }
}
