@extends('layouts.app')

@section('content')
    <div class="container text-white">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- NEW: Back to Dashboard Link -->
                <div class="mb-3">
                    <a href="{{ url('/') }}" class="text-muted text-decoration-none small fw-bold nav-link d-inline-block"
                        style="padding: 0 !important;">
                        &larr; Return to Dashboard
                    </a>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold mb-0">Crew Profile Overview</h2>
                    <span class="text-muted">System ID: {{ $user->id }}</span>
                </div>

                @if (session('success'))
                    <div
                        class="alert alert-success bg-success bg-opacity-25 text-success border border-success fw-bold shadow-sm mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card bg-dark border-secondary shadow-sm mb-4">
                    <div
                        class="card-header bg-secondary fw-bold text-white d-flex justify-content-between align-items-center">
                        <span>Personal Data Link</span>
                        <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-info fw-bold"
                            style="color: #ff9999; border-color: #ff3333;">Edit Profile</a>
                    </div>
                    <div class="card-body p-4">
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted fw-bold">Full Name</div>
                            <div class="col-sm-8 text-white">{{ $user->name }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted fw-bold">System Email</div>
                            <div class="col-sm-8 text-white">{{ $user->email }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted fw-bold">Clearance Level</div>
                            <div class="col-sm-8">
                                @if($user->isCrewLead())
                                    <span class="badge bg-danger">ADMIN</span>
                                @else
                                    <span
                                        class="badge bg-secondary border border-secondary">{{ $user->tier->name ?? 'Unassigned' }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 text-muted fw-bold">Account Created</div>
                            <div class="col-sm-8 text-white-50">{{ $user->created_at->format('F j, Y') }}</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection