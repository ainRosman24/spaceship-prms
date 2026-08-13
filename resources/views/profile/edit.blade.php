@extends('layouts.app')

@section('content')
    <div class="container text-white">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold mb-0">Crew Profile Configuration</h2>
                    <span class="text-muted">System ID: {{ $user->id }}</span>
                </div>

                @if (session('success'))
                    <div
                        class="alert alert-success bg-success bg-opacity-25 text-success border border-success fw-bold shadow-sm mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card bg-dark border-secondary shadow-sm">
                    <div class="card-header bg-secondary fw-bold text-white">
                        Personal Data Link
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PATCH')

                            <div class="mb-4">
                                <label class="form-label text-white-50">Full Name</label>
                                <input type="text" name="name" class="form-control bg-dark text-white border-secondary"
                                    value="{{ old('name', $user->name) }}" required>
                                @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-white-50">System Email (Login ID)</label>
                                <input type="email" name="email" class="form-control bg-dark text-white border-secondary"
                                    value="{{ old('email', $user->email) }}" required>
                                @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <hr class="border-secondary my-4">
                            <h6 class="text-white fw-bold mb-3">Security Override (Optional)</h6>
                            <p class="text-muted small mb-3">Leave these fields blank if you wish to keep your current
                                access code.</p>

                            <div class="mb-4">
                                <label class="form-label text-white-50">New Access Code (Password)</label>
                                <input type="password" name="password"
                                    class="form-control bg-dark text-white border-secondary">
                                @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-white-50">Confirm Access Code</label>
                                <input type="password" name="password_confirmation"
                                    class="form-control bg-dark text-white border-secondary">
                            </div>

                            <div class="d-flex justify-content-end mt-4 gap-2">
                                <a href="{{ route('profile.show') }}"
                                    class="btn btn-outline-secondary px-4 fw-bold">Cancel</a>
                                <button type="submit" class="btn btn-primary px-4 fw-bold">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection