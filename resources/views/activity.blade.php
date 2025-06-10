@extends('layout')
@section('content')
    <div class="container my-3">
        <div class="card shadow">
            <div class="card-header text-white" style="background: linear-gradient(to right, #4e73df, #224abe)">
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
                                            @case('active')
                                                bg-success
                                                @break
                                            @case('completed')
                                                bg-secondary
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

                <div class="mt-4">
                    <div class="d-flex flex-wrap gap-2 justify-content-end">
                        {{-- Back Button --}}
                        <a href="/activities" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Back
                        </a>

                        {{-- Status Update Buttons --}}
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Update Status
                            </button>
                            <ul class="dropdown-menu">
                                @foreach (['active', 'completed', 'cancelled'] as $status)
                                    <li>
                                        <form action="{{ route('activities.edit', $activity->activity_id) }}" method="POST" class="dropdown-item-form">
                                            @csrf
                                            <input type="hidden" name="status" value="{{ $status }}">
                                            <button type="submit" class="dropdown-item text-capitalize">
                                                {{ $status }}
                                            </button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        {{-- Delete Button --}}
                        <form action="{{ route('activities.delete', $activity->activity_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this activity?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash me-1"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>

                <style>
                    /* Allow dropdown items to work with forms */
                    .dropdown-item-form {
                        margin: 0;
                        padding: 0;
                    }

                    .dropdown-item-form button {
                        width: 100%;
                        text-align: left;
                    }
                </style>
            </div>
        </div>
    </div>
@endsection
