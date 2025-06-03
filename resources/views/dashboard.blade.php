@extends('layout')
@section('content')
    <div class="container py-4">
        <div class="mb-4">
            <h2 class="text-primary">Welcome back, Salman!</h2>
            <p class="text-muted">Here's an overview of your recent academic activities.</p>
        </div>

        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card bg-white shadow-sm border-left-primary h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h5 mb-0 font-weight-bold text-primary">{{ $upcomingCount + $ongoingCount + $completedCount }}</div>
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
        <div class="card shadow-sm mb-4">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th>Activity Name</th>
                            <th>Category</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ongoingActivities as $activity)
                        <tr>
                            <td>{{ $activity->title }}</td>
                            <td>{{ $activity->category }}</td>
                            <td>{{ date('M d, Y', strtotime($activity->end_date)) }}</td>
                            <td><span class="badge bg-warning text-dark">{{ $activity->status }}</span></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="/activities" class="btn btn-primary btn-sm">View</a>
                                    <a href="/activities" class="btn btn-success btn-sm">Complete</a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No ongoing activities found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <h3 class="h4 text-dark mb-3">Upcoming Activities</h3>
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th>Activity Name</th>
                            <th>Category</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($upcomingActivities as $activity)
                        <tr>
                            <td>{{ $activity->title }}</td>
                            <td>{{ $activity->category }}</td>
                            <td>{{ date('M d, Y', strtotime($activity->end_date)) }}</td>
                            <td><span class="badge bg-info">{{ $activity->status }}</span></td>
                            <td>
                                <a href="/activities" class="btn btn-primary btn-sm">View</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No upcoming activities found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
