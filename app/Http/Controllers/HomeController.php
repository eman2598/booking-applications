<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;

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

    public function checkout(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'status' => 'nullable|string|in:paid,free',
        ]);

        $userId = Auth::id();
        $eventId = $request->event_id;
        $event = Event::findOrFail($eventId);

        try {
            $booking = Booking::create([
                'user_id' => $userId,
                'events_id' => $eventId,
                'status' => $request->status ?? 'paid',
            ]);

            return redirect()->route('site.thanku')->with('success_msg', 'Your Booking Confirmed');
        } catch (\Exception $ex) {
            Log::error('Booking failed: ' . $ex->getMessage());
            return back()->with('booking_failed', 'Your booking has failed, please try again');
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
