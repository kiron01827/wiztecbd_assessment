@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-3">
                <a href="{{ route('home') }}">< Going Back</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h1>{{ ('Event Bookings') }}</h1>
                    <h5>{{ $event->name }}</h4>
                </div>

                <div class="card-body">
                    @if (count($bookings) == 0)
                        <p class="text-center"> The is no booking here.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Booking User</th>
                                        <th scope="col">Total Seats</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                        $total = 0;
                                    @endphp
                                    @foreach ($bookings as $key => $booking)
                                        <tr>
                                            <th scope="row">{{ $i }}</th>
                                            <td>{{ $booking->user->name }}</td>
                                            <td>{{ $booking->seats_booked }}</td>
                                        </tr>
                                        @php
                                            $total += $booking->seats_booked;
                                            $i++;
                                        @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2" style="text-align:right;">Total</td>
                                        <th>{{ $total }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
