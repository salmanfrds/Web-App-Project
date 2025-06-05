@extends('layout')
@section('content')
<div class="container py-5">
    <div class="card mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
            <h4 class="mb-0 fw-bold"><i class="fas fa-list-ul me-2"></i> Activities List</h4>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 px-4">Title</th>
                            <th class="py-3 px-4">Description</th>
                            <th class="py-3 px-4">Start Date</th>
                            <th class="py-3 px-4">End Date</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4">Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($activities as $activity)
                            <tr class="clickable-row" style="cursor: pointer;" onclick="window.location='{{ route('activities.view', $activity->activity_id) }}'">
                                <td class="px-4 py-3">{{ $activity->title }}</td>
                                <td class="px-4 py-3">{{ Str::limit($activity->description, 50) }}</td>
                                <td class="px-4 py-3">
                                    <span class="badge bg-info text-dark rounded-pill">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        {{ \Carbon\Carbon::parse($activity->start_date)->format('M d, Y') }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="badge bg-warning text-dark rounded-pill">
                                        <i class="far fa-calendar-check me-1"></i>
                                        {{ \Carbon\Carbon::parse($activity->end_date)->format('M d, Y') }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    @if($activity->status == 'upcoming')
                                        <span class="badge bg-info rounded-pill">
                                            <i class="fas fa-hourglass-start me-1 small"></i> Upcoming
                                        </span>
                                    @elseif($activity->status == 'ongoing')
                                        <span class="badge bg-success rounded-pill">
                                            <i class="fas fa-circle me-1 small"></i> Ongoing
                                        </span>
                                    @elseif($activity->status == 'completed')
                                        <span class="badge bg-secondary rounded-pill">
                                            <i class="fas fa-check-circle me-1"></i> Completed
                                        </span>
                                    @elseif($activity->status == 'cancelled')
                                        <span class="badge bg-danger rounded-pill">
                                            <i class="fas fa-ban me-1"></i> Cancelled
                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark rounded-pill">
                                            <i class="fas fa-question-circle me-1"></i> {{ $activity->status }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <span class="badge bg-primary rounded-pill">
                                        <i class="fas fa-tag me-1"></i> {{ $activity->category }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fas fa-clipboard fa-3x mb-3 opacity-25"></i>
                                    <p class="mb-0">No activities found</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Floating Button -->
    <div class="position-fixed bottom-0 end-0 p-4">
        <a href="/activities/add" class="btn btn-primary btn-lg rounded-circle shadow-lg d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;" data-bs-toggle="tooltip" data-bs-placement="left" title="Add New Activity">
            <i class="fas fa-plus fa-lg"></i>
        </a>
    </div>
</div>

<!-- Initialize tooltips -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endsection
