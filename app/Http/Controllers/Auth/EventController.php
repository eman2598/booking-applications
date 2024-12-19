<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Event\CreateRequest;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'I am index page';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
            session()->flash('Event saved successfully');
            return to_route('events.index');
        } catch (\Exception $ex) {
            return back()->withErrors('Something went wrong, the error is: ' . $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
