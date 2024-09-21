@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h1>{{ ('Create Events') }}</h1>
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
                    <form method="POST" action="{{ route('events.store') }}">
                        @csrf
                        <!-- Name -->
                        <div class="mb-3">
                          <label for="name">Name</label>
                          <input type="text" class="form-control" name="name" required>
                        </div>
                        <!-- Description -->
                        <div class="mb-3">
                          <label for="description">Description</label>
                          <textarea rows="3" class="form-control" name="description" required></textarea>
                        </div>
                        <!-- Date -->
                        <div class="mb-3">
                          <label for="date">Date</label>
                          <input type="datetime-local" class="form-control" name="date" required>
                        </div>
                        <!-- Total Seats -->
                        <div class="mb-3">
                          <label for="total_seats">Total Seats</label>
                          <input type="number" class="form-control" name="total_seats" required>
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
