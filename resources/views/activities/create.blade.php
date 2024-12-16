@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Activity</h1>

    <form action="{{ route('activities.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Activity Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="activity_text">Activity Description</label>
            <textarea name="activity_text" id="activity_text" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Create Activity</button>
    </form>
</div>
@endsection
