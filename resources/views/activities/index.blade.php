@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Activities List</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(Auth::user()->role != 'admin')
        <a href="{{ route('activities.create') }}" class="btn btn-primary mb-3">New Activity</a>
        @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $id = 1 ?>
            @if($activities->isEmpty())
                <tr align="center">
                    <td colspan="6" class="fw-bold fs-1">No activities found.</td>
                </tr>
            @else
            @foreach($activities as $activity)
            
            <tr>
                <td>{{ $id++ }}</td>
                <td>{{ $activity->user->name }}</td>
                <td>{{ $activity->name }}</td>
                <td>{{ Str::limit($activity->activity_text, 50) }}</td>
                <td>{{ ucfirst($activity->status) }}</td>
                <td>
                    <a href="{{ route('activities.edit', $activity->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('activities.destroy', $activity->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                    <!-- Button to trigger modal -->
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#activityDetailModal{{ $activity->id }}">
                        Detail
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="activityDetailModal{{ $activity->id }}" tabindex="-1" aria-labelledby="activityDetailModalLabel{{ $activity->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="activityDetailModalLabel{{ $activity->id }}">Activity Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h4>{{ $activity->name }}</h4>
                                    <p>{{ $activity->activity_text }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (Auth::user()->role == 'admin')
                    <!-- Button to change status -->
                    <form action="{{ route('activities.updateStatus', ['activity' => $activity->id, 'status' => 'approved']) }}" method="POST" style="display:inline-block; margin-top: 5px;">

                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-primary btn-sm">
                            Approve
                        </button>
                    </form>

                    <form action="{{ route('activities.updateStatus', ['activity' => $activity->id, 'status' => 'rejected']) }}" method="POST" style="display:inline-block; margin-top: 5px;">

                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-danger btn-sm">
                            Reject
                        </button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $activities->links() }}
    </div>
</div>
@endsection
