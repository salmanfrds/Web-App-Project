@extends('layout')
@section('content')
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h1 class="mb-0">{{ $activity->title }}</h1>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-8">
                        <h5 class="text-muted mb-3">Description</h5>
                        <p class="lead">{{ $activity->description }}</p>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-light">
                            <div class="card-body">
                                <div class="mb-3">
                                    <h6 class="text-muted">Status</h6>
                                    <span class="badge
                                        @switch($activity->status)
                                            @case('upcoming')
                                                bg-info
                                                @break
                                            @case('ongoing')
                                                bg-primary
                                                @break
                                            @case('completed')
                                                bg-success
                                                @break
                                            @case('cancelled')
                                                bg-danger
                                                @break
                                            @default
                                                bg-secondary
                                        @endswitch
                                        p-2 fs-6 w-100 text-center">
                                        {{ ucfirst($activity->status) }}
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <h6 class="text-muted">Category</h6>
                                    <p class="fw-bold">{{ ucfirst($activity->category) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <h5 class="text-muted">Start Date</h5>
                            <p class="fw-bold">{{ \Carbon\Carbon::parse($activity->start_date)->format('F j, Y') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <h5 class="text-muted">End Date</h5>
                            <p class="fw-bold">{{ \Carbon\Carbon::parse($activity->end_date)->format('F j, Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-3 d-flex flex-wrap gap-2 justify-content-end">
                    {{-- Status Update Buttons --}}
                    @foreach (['upcoming', 'ongoing', 'completed', 'cancelled'] as $status)
                        <form action="{{ route('activities.edit', $activity->activity_id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="{{ $status }}">
                            <button type="submit" class="btn btn-outline-primary btn-sm text-capitalize">
                                {{ $status }}
                            </button>
                        </form>
                    @endforeach

                    {{-- Delete Button --}}
                    <form action="{{ route('activities.delete', $activity->activity_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this activity?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            Delete
                        </button>
                    </form>

                    {{-- Back Button --}}
                    <a href="/activities" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
