@extends('layout')
@section('content')
    <div class="container py-3">
        <div class="mb-2">
            <h2 class="text-gradient">Welcome back, {{ $name }}!</h2>
            <style>
                .text-gradient {
                    background: linear-gradient(to right, #4e73df, #224abe);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    background-clip: text;
                    color: #4e73df; /* Fallback */
                    font-weight: 650;
                }
            </style>
            <p class="text-muted">Here's an overview of your recent activities.</p>
        </div>

        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card bg-white shadow-sm border-left-primary h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h5 mb-0 font-weight-bold text-primary">{{ $activitiesCount }}</div>
                                <div class="text-xs font-weight-bold text-muted text-uppercase">Total Activities</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card bg-white shadow-sm border-left-success h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h5 mb-0 font-weight-bold text-success">{{ $completedCount }}</div>
                                <div class="text-xs font-weight-bold text-muted text-uppercase">Completed Activities</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card bg-white shadow-sm border-left-info h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h5 mb-0 font-weight-bold text-info">{{ $upcomingCount }}</div>
                                <div class="text-xs font-weight-bold text-muted text-uppercase">Upcoming Activities</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clock fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="h4 text-dark mb-3">Ongoing Activities</h3>
        <div class="card shadow-sm mb-4 rounded">
            <div class="table-responsive">
                <table class="table table-hover table-sm-mobile">
                    <thead class="table-light">
                        <tr>
                            <th class="fs-md-normal fs-sm">Activity</th>
                            <th class="fs-md-normal fs-sm">Category</th>
                            <th class="fs-md-normal fs-sm">Due</th>
                            <th class="d-none d-md-table-cell fs-md-normal fs-sm">Status</th>
                            <th class="fs-md-normal fs-sm">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ongoingActivities as $activity)
                            <tr>
                                <td style="word-break: break-word" class="fs-md-normal fs-sm border-md-end">
                                    <span class="fw-medium">{{ $activity->title }}</span>
                                </td>
                                <td style="word-break: break-word" class="fs-md-normal fs-sm border-md-end">
                                    <span class="badge bg-light text-dark">{{ $activity->category }}</span>
                                </td>
                                <td class="fs-md-normal fs-sm border-md-end">
                                    <i class="far fa-calendar-alt me-1 text-muted"></i> {{ date('M d, Y', strtotime($activity->end_date)) }}
                                </td>
                                <td class="d-none d-md-table-cell border-md-end">
                                    <span class="badge bg-warning text-dark fs-md-normal fs-sm">{{ $activity->status }}</span>
                                </td>
                                <td>
                                    <div class="d-flex flex-column flex-md-row gap-1">
                                        <a href="{{ route('activities.view', $activity->activity_id) }}"
                                            class="btn btn-primary btn-sm mb-1 mb-md-0 me-md-1">
                                            <i class="fas fa-eye me-1"></i> View
                                        </a>
                                        <form action="{{ route('activities.edit', $activity->activity_id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fas fa-check me-1"></i> Complete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 fs-md-normal fs-sm text-muted">
                                    <i class="fas fa-clipboard-list fa-2x mb-2 d-block"></i>
                                    No ongoing activities found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <h3 class="h4 text-dark mb-3">Upcoming Activities</h3>
        <div class="card shadow-sm mb-4 rounded">
            <div class="table-responsive">
            <table class="table table-hover table-sm-mobile">
                <thead class="table-light">
                <tr>
                    <th class="fs-md-normal fs-sm">Activity</th>
                    <th class="fs-md-normal fs-sm">Category</th>
                    <th class="fs-md-normal fs-sm">Due</th>
                    <th class="d-none d-md-table-cell fs-md-normal fs-sm">Status</th>
                    <th class="fs-md-normal fs-sm">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($upcomingActivities as $activity)
                    <tr>
                    <td style="word-break: break-word" class="fs-md-normal fs-sm border-md-end">
                        <span class="fw-medium">{{ $activity->title }}</span>
                    </td>
                    <td style="word-break: break-word" class="fs-md-normal fs-sm border-md-end">
                        <span class="badge bg-light text-dark">{{ $activity->category }}</span>
                    </td>
                    <td class="fs-md-normal fs-sm border-md-end">
                        <i class="far fa-calendar-alt me-1 text-muted"></i> {{ date('M d, Y', strtotime($activity->end_date)) }}
                    </td>
                    <td class="d-none d-md-table-cell border-md-end">
                        <span class="badge bg-info text-white fs-md-normal fs-sm">{{ $activity->status }}</span>
                    </td>
                    <td>
                        <a href="{{ route('activities.view', $activity->activity_id) }}"
                        class="btn btn-primary btn-sm">
                        <i class="fas fa-eye me-1"></i> View
                        </a>
                    </td>
                    </tr>
                @empty
                    <tr>
                    <td colspan="5" class="text-center py-4 fs-md-normal fs-sm text-muted">
                        <i class="fas fa-calendar fa-2x mb-2 d-block"></i>
                        No upcoming activities found.
                    </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            </div>
        </div>
    </div>
@endsection
