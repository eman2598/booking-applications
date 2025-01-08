<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Event\CreateRequest;
use App\Http\Requests\Auth\Event\UpdateRequest;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $eventsQuery = $user->role === 'user'
            ? Event::whereIn('id', Booking::where('user_id', $user->id)
                ->whereIn('status', ['paid', 'free'])
                ->pluck('events_id'))
            : Event::query();

        $events = $eventsQuery->get();

        return view('auth.events.index', compact('events'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! auth()->user()->role == 'admin') {
            return abort(403, 'You are not authorized for this page');
        }
        $categories = Category::all();
        return view('auth.events.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $categoryId = null;
        $category = Category::find($request->category);

        if (! $category) {
            return back()->withErrors('Unable to find category. Please choosethe correct value.');
        }
        try {
            Event::create([
                'name' => $request->name,
                'description' => $request->description,
                'category_id' => $category ? $category->id : null,
                'location' => $request->location,
                'type' => $request->type,
                'price' => $request->price,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'max_attendence' => $request->max_attendence,
            ]);
            session()->flash('success_msg', 'Event saved successfully');
            return to_route('events.index');
        } catch (\Exception $ex) {
            return back()->withInput()->withErrors('Something went wrong, the error is: ' . $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        // $event = Event::findOrFail($id);
        return view('auth.events.show', ['event' => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        if (! auth()->user()->role == 'admin') {
            return abort(403, 'You are not authorized for this page');
        }
        $categories = Category::all();
        return view('auth.events.edit', compact('categories', 'event'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Event $event)
    {
        $categoryId = null;
        $category = Category::find($request->category);

        if (! $category) {
            return back()->withErrors('Unable to find category. Please choosethe correct value.');
        }
        try {
            $event->update([
                'name' => $request->name,
                'description' => $request->description,
                'category_id' => $category ? $category->id : null,
                'location' => $request->location,
                'type' => $request->type,
                'price' => $request->price,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'max_attendence' => $request->max_attendence,
            ]);
            session()->flash('success_msg', 'Post Updated Successfully');
            return to_route('events.index');
        } catch (\Exception $ex) {
            return back()->withInput()->withErrors('Something went wrong, the error is: ' . $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        if (! auth()->user()->role == 'admin') {
            return abort(403, 'You are not authorized for this page');
        }
        try {
            $event->delete();

            session()->flash('success_msg', 'Event deleted successfully.');
        } catch (\Exception $ex) {
            session()->flash('error_msg', 'Something went wrong. The error is: ' . $ex->getMessage());
        }

        return to_route('events.index');
    }
}
