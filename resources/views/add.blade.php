@extends('layout')

@section('content')
<div class="container py-1">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-12">
            <div class="card shadow">
                <div class="card-header text-white font-weight-bold" style="background: linear-gradient(to right, #4e73df, #224abe)">
                    <h4 class="mb-0">Add New Activity</h4>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('activities.store') }}">
                        @csrf

                        <div class="form-group row mb-4">
                            <label for="title" class="col-md-4 col-form-label text-md-right fw-bold">Title</label>
                            <div class="col-md-8">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autofocus placeholder="Enter activity title">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="description" class="col-md-4 col-form-label text-md-right fw-bold">Description</label>
                            <div class="col-md-8">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required rows="4" placeholder="Enter activity description">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- add comment --}}

                        <div class="form-group row mb-4">
                            <label for="start_date" class="col-md-4 col-form-label text-md-right fw-bold">Start Date</label>
                            <div class="col-md-8">
                                <input id="start_date" type="datetime-local" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date') }}" required>
                                @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="end_date" class="col-md-4 col-form-label text-md-right fw-bold">End Date</label>
                            <div class="col-md-8">
                                <input id="end_date" type="datetime-local" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date') }}" required>
                                @error('end_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="category" class="col-md-4 col-form-label text-md-right fw-bold">Category</label>
                            <div class="col-md-8">
                                <select id="category" class="form-select @error('category') is-invalid @enderror" name="category" required>
                                    <option value="">Select Category</option>
                                    <option value="academic">Academic</option>
                                    <option value="sports">Sports</option>
                                    <option value="culture">Culture</option>
                                    <option value="organization">Organization</option>
                                    <option value="other">Other</option>
                                </select>
                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-5">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn text-white px-4 py-2" style="background: linear-gradient(to right, #4e73df, #224abe)">
                                    <i class="fas fa-plus-circle me-2"></i> Add Activity
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
