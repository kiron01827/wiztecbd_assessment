@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-3">
                <a href="{{ route('home') }}">< Going Back</a>
            </div>
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h1>{{ ('Booking Details') }}</h1>
                </div>

                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-3"><strong>Event Name</strong></div>
                        <div class="col-md-9">{{ $booking->event->name }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3"><strong>Event Date</strong></div>
                        <div class="col-md-9">{{ $booking->event->date }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3"><strong>Event Details</strong></div>
                        <div class="col-md-9">{{ $booking->event->description }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"><strong>Total Seats</strong></div>
                        <div class="col-md-9">{{ $booking->seats_booked }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
