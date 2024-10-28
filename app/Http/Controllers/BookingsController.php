<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingsController extends Controller
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
        $events = Event::where('date', '>=', strtotime(date('Y-m-d')))->get();
        return view('bookings.create', compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required',
            'seats_booked' => 'required|numeric'
        ]);

        $old_booking = Booking::where('event_id', $request->event_id)->where('user_id', Auth::id())->first();
        if ($old_booking) {
            flash('Your have already booked seats for this event')->error();
            return redirect()->back();
        }

        // locking bookings
        $result = DB::transaction(function ()  use ($request) {
            $event = Event::lockForUpdate()->findOrFail($request->event_id);
            return $this->updateSeats($event, $request->seats_booked);
        });

        if($result){
            flash('A New Event has been booked successfully')->success();
            return redirect()->route('home');
        }else{
            flash('Your booking tickects are exceeded the available seats')->error();
            return redirect()->route('home');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = Booking::findOrFail($id);
        return view('bookings.show', compact('booking'));
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

    public static function updateSeats($event, $seats)
    {
        if ($event->available_seats < $seats) {
            return false;
        }

        $booking = new Booking();
        $booking->event_id = $event->id;
        $booking->seats_booked = $seats;
        $booking->user_id = Auth::id();
        $booking->save();

        $event->update(['available_seats' => $event->available_seats - $seats]);
        return true;
    }
}
