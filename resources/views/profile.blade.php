@extends('layout')
@section('content')
<div class="container my-2">
    @if(Auth::check())
        <div class="card shadow-lg border-0 mx-auto overflow-hidden" style="max-width: 700px; border-radius: 15px;">
            <div class="card-header bg-gradient-primary text-white text-center py-4" style="background: linear-gradient(to right, #4e73df, #224abe);">
                <h3 class="mb-0 font-weight-bold">My Profile</h3>
            </div>

            <div class="card-body p-0">
                <div class="bg-light p-4 text-center">
                    @if(Auth::user()->profile_picture)
                        <img src="{{ asset('storage/images/' . Auth::user()->profile_picture) }}" class="rounded-circle mb-3 shadow border border-white" width="150" height="150" alt="Profile Picture" style="object-fit: cover;">
                    @else
                        <img src="http://localhost:8000/images/noimageprofile.jpg" class="rounded-circle mb-3 shadow border border-white" width="150" height="150" alt="Default Profile Picture">
                    @endif
                    <h4 class="font-weight-bold mb-0">{{ Auth::user()->name }}</h4>
                    <p class="text-muted small">{{ Auth::user()->email }}</p>
                </div>

                <div class="row m-0 p-4">
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 border-left-primary shadow-sm py-2">
                            <div class="card-body">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Matric Number</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ Auth::user()->matric_number ?? 'Not provided' }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 border-left-success shadow-sm py-2">
                            <div class="card-body">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Kulliyah</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ Auth::user()->kulliyah ?? 'Not provided' }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 border-left-info shadow-sm py-2">
                            <div class="card-body">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Gender</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ Auth::user()->gender ?? 'Not provided' }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 border-left-warning shadow-sm py-2">
                            <div class="card-body">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Date of Birth</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ Auth::user()->dob ?? 'Not provided' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-4 border-top">
                    <h5 class="mb-3 font-weight-bold">About Me</h5>
                    <p class="text-muted mb-0">{{ Auth::user()->bio ?? 'No bio available' }}</p>
                </div>

                <div class="card-footer bg-white text-center py-3">
                    <a href="/profile/edit" class="btn btn-primary btn-sm shadow-sm"><i class="fas fa-edit mr-1"></i> Edit Profile</a>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning shadow-sm text-center py-4 rounded-lg">
            <i class="fas fa-exclamation-triangle mr-2"></i> User not authenticated. Please log in to view your profile.
        </div>
    @endif
</div>
@endsection
