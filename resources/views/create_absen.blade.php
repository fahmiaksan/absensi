@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Create Attendance</h1>

    <div class="card">
        <div class="card-body">
            <!-- Form untuk input data absensi -->
            <form action="{{ route('absen.store') }}" method="POST">
                @csrf <!-- Token keamanan Laravel -->
                
                <!-- Input untuk User -->
                <div class="mb-3">
                    <label for="user_id" class="form-label">User</label>
                    <input type="text" disabled name="user_id" id="user_id" value="{{ Auth::user()->name }}" class="form-control" required>
                </div>

                <!-- Input untuk Check In -->
                <div class="mb-3">
                    <label for="check_in" class="form-label">Check In</label>
                    <input type="datetime-local" id="check_in" name="check_in" class="form-control" required>
                </div>

                <!-- Input untuk Check Out -->
                <div class="mb-3">
                    <label for="check_out" class="form-label">Check Out</label>
                    <input type="datetime-local" id="check_out" name="check_out" class="form-control">
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary">Create Attendance</button>
                <a href="{{ route('absen.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection
