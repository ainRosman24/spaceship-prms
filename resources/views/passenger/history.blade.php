@extends('layouts.app')

@section('content')
<div class="container text-white">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Passenger Terminal</h2>
        <span class="text-muted">Clearance: <span class="badge bg-secondary border border-secondary">{{ $user->tier->name ?? 'Unassigned' }}</span></span>
    </div>

    <!-- Include the clickable tabs -->
    @include('passenger.partials.tabs')

    <!-- USAGE HISTORY CONTENT -->
    <div class="card bg-dark border-secondary mb-4 shadow-sm">
        <div class="card-body p-3">
            <form method="GET" action="{{ route('passenger.history') }}" class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label class="form-label text-muted small fw-bold text-uppercase mb-1">Start Date</label>
                    <input type="date" name="start_date" class="form-control bg-dark text-white border-secondary" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label text-muted small fw-bold text-uppercase mb-1">End Date</label>
                    <input type="date" name="end_date" class="form-control bg-dark text-white border-secondary" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-outline-info w-100 fw-bold" style="color: #ff9999; border-color: #ff3333;">
                        Apply Filter
                    </button>
                    
                    @if(request()->filled('start_date') || request()->filled('end_date'))
                        <a href="{{ route('passenger.history') }}" class="btn btn-outline-secondary fw-bold">
                            Clear
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="card bg-dark border-secondary shadow-sm">
        <div class="card-header bg-secondary fw-bold text-white">
            Personal Interaction Logs
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="text-muted">Date & Time</th>
                            <th class="text-muted">Facility</th>
                            <th class="text-muted">Access Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($history as $log)
                            <tr>
                                <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                                <td class="fw-bold">{{ $log->resource->name }}</td>
                                <td>
                                    @if($log->access_status === 'granted')
                                        <span class="badge bg-success bg-opacity-25 text-success border border-success">GRANTED</span>
                                    @else
                                        <span class="badge bg-danger bg-opacity-25 text-danger border border-danger">DENIED</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">No interaction logs found for this date range.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection