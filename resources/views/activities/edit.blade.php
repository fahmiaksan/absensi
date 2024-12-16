@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Activity</h1>
    {{ session('success') }}

    <form action="{{ route('activities.updated', $activity->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Activity Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $activity->name) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Activity Description</label>
            <textarea name="activity_text" id="description" class="form-control" required>{{ old('description', $activity->activity_text) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Activity</button>
    </form>
</div>
@endsection
