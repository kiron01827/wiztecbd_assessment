@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h1>{{ ('Booking New Event') }}</h1>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('bookings.store') }}">
                        @csrf
                        <!-- Name -->
                        <div class="mb-3">
                          <label for="event_id">Name</label>
                          <select name="event_id" class="form-control" onchange="getEventData(this.value)" required>
                            <option value="">Select Event</option>
                            @foreach ($events as $event)
                            <option value="{{ $event->id }}">{{ $event->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <!-- Event Date -->
                        <div class="mb-3">
                          <label for="date">Event Date</label>
                          <input type="datetime-local" class="form-control" id="date" readonly>
                        </div>
                        <!-- Availbale Seats -->
                        <div class="mb-3">
                          <label for="available_seats">Availbale Seats</label>
                          <input type="number" class="form-control" id="available_seats" readonly>
                        </div>
                        <!-- Book Seats -->
                        <div class="mb-3">
                          <label for="seats_booked">Book Seats</label>
                          <input type="number" class="form-control" max="1" name="seats_booked" id="seats_booked" required>
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function getEventData(value) {
        $('#date').val('');
        $('#available_seats').val('');
        $.post('{{ route("getEventData") }}',{_token:'{{ csrf_token() }}', id:value}, function(data){
            $('#date').val(data.date);
            $('#available_seats').val(data.available_seats);
            $('#seats_booked').attr('max', data.available_seats);
        });
    }
</script>
@endsection
