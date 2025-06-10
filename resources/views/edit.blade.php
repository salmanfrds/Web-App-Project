@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Profile</div>

                <div class="card-body">
                    <form method="POST" action="/profile/edit" enctype="multipart/form-data">
                        @csrf
                        {{-- Name --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="{{ old('name', $name) }}" required>
                        </div>

                        {{-- Matric Number --}}
                        <div class="mb-3">
                            <label for="matric_number" class="form-label">Matric Number</label>
                            <input type="text" class="form-control" id="matric_number" name="matric_number"
                                   value="{{ old('matric_number', $matric_number) }}">
                        </div>

                        {{-- Kulliyah --}}
                        <div class="mb-3">
                            <label for="kulliyah" class="form-label">Kulliyah</label>
                            <select class="form-select" id="kulliyah" name="kulliyah">
                                <option value="">Select Kulliyah</option>
                                @foreach ($kulliyahList as $option)
                                    <option value="{{ $option }}" {{ old('kulliyah', $kulliyah) == $option ? 'selected' : '' }}>
                                        {{ $option }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Gender --}}
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender" name="gender">
                                <option value="">Select Gender</option>
                                @foreach ($genderOptions as $option)
                                    <option value="{{ $option }}" {{ old('gender', $gender) == $option ? 'selected' : '' }}>
                                        {{ $option }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Date of Birth --}}
                        <div class="mb-3">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob"
                                   value="{{ old('dob', $dob ? \Carbon\Carbon::parse($dob)->format('Y-m-d') : '') }}">
                        </div>

                        {{-- Image Upload --}}
                        <div class="mb-3">
                            <label for="image" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            @if(isset($image))
                                <div class="mt-2">
                                    <small class="text-muted">Current image: {{ $image }}</small>
                                </div>
                            @endif
                        </div>

                        {{-- Bio --}}
                        <div class="mb-3">
                            <label for="bio" class="form-label">Biography</label>
                            <textarea class="form-control" id="bio" name="bio" rows="4">{{ old('bio', $bio ?? '') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
