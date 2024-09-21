<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'date' => 'required',
            'total_seats' => 'required|numeric'
        ]);

        $event = new Event();
        $event->name = $request->name;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->total_seats = $request->total_seats;
        $event->available_seats = $request->total_seats;
        $event->save();

        flash('Event has been inserted successfully')->success();
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::findOrFail($id);
        $bookings = Booking::where('event_id', $id)->get();
        return view('events.show', compact('event', 'bookings'));
    }

    public function show_bookings($id)
    {
        $event = Event::findOrFail($id);
        $bookings = Booking::where('event_id', $id)->get();
        return view('events.bookings', compact('event', 'bookings'));
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

    public function getEventData(Request $request)
    {
        $event = Event::findOrFail($request->id);
        return $event;
    }
}
