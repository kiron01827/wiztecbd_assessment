@extends('layouts.app')

@section('content')
<div class="container">
    @if (Auth::user()->type == 'admin')
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h1>{{ ('Events') }}</h1>
                        <!-- Add Button -->
                        <a href="{{ route('events.create') }}" type="button" class="btn btn-primary">Add New</a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Total Seats</th>
                                        <th scope="col">Available Seats</th>
                                        <th scope="col" class="text-right">Show</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $key => $event)
                                    <tr>
                                        <th scope="row">
                                            {{ ($key+1) + ($events->currentPage() - 1)*$events->perPage() }}
                                        </th>
                                        <td>{{ $event->name }}</td>
                                        <td>{{ date('Y-d-m h:i a', strtotime($event->date)) }}</td>
                                        <td>{{ $event->total_seats }}</td>
                                        <td>{{ $event->available_seats }}</td>
                                        <td class="text-right">
                                            <a class="btn btn-info" href="{{ route('events.show', [$event->id]) }}">Details</a>
                                            <a class="btn btn-primary" href="{{ route('events.show_bookings', [$event->id]) }}">Bookings</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="theme-pagination">
                            {{ $events->appends(request()->input())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif(Auth::user()->type == 'user')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h1>{{ ('Event Bookings') }}</h1>
                    <!-- Add Button -->
                    <a href="{{ route('bookings.create') }}" type="button" class="btn btn-primary">Book new Event</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Event Name</th>
                                    <th scope="col">Event Date</th>
                                    <th scope="col">Total Seats</th>
                                    <th scope="col">Event Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $key => $booking)
                                <tr>
                                    <th scope="row">
                                        {{ ($key+1) + ($bookings->currentPage() - 1)*$bookings->perPage() }}
                                    </th>
                                    <td>{{ $booking->event->name }}</td>
                                    <td>{{ date('Y-d-m h:i a', strtotime($booking->event->date)) }}</td>
                                    <td>{{ $booking->seats_booked }}</td>
                                    <td><a href="{{ route('bookings.show', [$booking->id]) }}">Show</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="theme-pagination">
                        {{ $bookings->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
