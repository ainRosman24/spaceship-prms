@extends('layouts.app')

@section('content')
<div class="container text-white">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Crew Lead Command Center</h2>
        <span class="text-muted">Live System Oversight</span>
    </div>

    @include('admin.partials.tabs')

    <!-- SYSTEM LOG FILTERS -->
    <div class="card bg-dark border-secondary mb-4 shadow-sm">
        <div class="card-body p-3">
            <form method="GET" action="{{ route('admin.logs') }}" class="row g-2 align-items-end">
                
                <!-- Passenger Filter (Updated with White Text Options) -->
                <div class="col-md-3">
                    <label class="form-label text-muted small fw-bold text-uppercase mb-1">Target Passenger</label>
                    <select name="user_id" class="form-select bg-dark text-white border-secondary" style="background-color: #0f172a; color: #ffffff;">
                        <option value="" style="background-color: #060913; color: #94a3b8;">-- All Passengers --</option>
                        @foreach($passengers as $passenger)
                            <option value="{{ $passenger->id }}" style="background-color: #0f172a; color: #ffffff;" {{ request('user_id') == $passenger->id ? 'selected' : '' }}>
                                {{ $passenger->name }} (P-{{ str_pad($passenger->id, 3, '0', STR_PAD_LEFT) }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label text-muted small fw-bold text-uppercase mb-1">Start Date</label>
                    <input type="date" name="start_date" class="form-control bg-dark text-white border-secondary" value="{{ request('start_date') }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label text-muted small fw-bold text-uppercase mb-1">End Date</label>
                    <input type="date" name="end_date" class="form-control bg-dark text-white border-secondary" value="{{ request('end_date') }}">
                </div>

                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-outline-info w-100 fw-bold" style="color: #ff9999; border-color: #ff3333;">
                        Apply Filter
                    </button>
                    
                    @if(request()->filled('start_date') || request()->filled('end_date') || request()->filled('user_id'))
                        <a href="{{ route('admin.logs') }}" class="btn btn-outline-secondary fw-bold">
                            Clear
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- LOGS TABLE -->
    <div class="card bg-dark border-secondary shadow-sm mb-4">
        <div class="card-header bg-secondary fw-bold text-white d-flex justify-content-between align-items-center">
            <span>Ship-wide Usage Logs</span>
            <span class="badge bg-dark border border-secondary text-muted">Page {{ $logs->currentPage() }} of {{ $logs->lastPage() }}</span>
        </div>
        <div class="card-body p-0 table-responsive">
            <table class="table table-dark table-sm table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-4 py-3">Time</th>
                        <th class="py-3">User</th>
                        <th class="py-3">Facility</th>
                        <th class="pe-4 py-3 text-end">Access Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td class="ps-4 py-2 text-muted" style="font-size: 0.85rem;">{{ $log->created_at->format('M d, H:i:s') }}</td>
                            <td class="py-2">
                                {{ $log->user->name }}
                                <br>
                                <span class="badge bg-secondary border border-secondary" style="font-size: 0.65rem;">{{ $log->user->tier->name ?? 'None' }}</span>
                            </td>
                            <td class="py-2 fw-bold text-white align-middle">{{ $log->resource->name }}</td>
                            <td class="pe-4 py-2 text-end align-middle">
                                @if($log->access_status === 'granted')
                                    <span class="badge bg-success bg-opacity-25 text-success border border-success">GRANTED</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-25 text-danger border border-danger">DENIED</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No interaction logs match your current filter parameters.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- NEW: Pagination Controls -->
        @if($logs->hasPages())
            <div class="card-footer border-secondary bg-dark d-flex justify-content-center pt-3 pb-1">
                {{-- appends(request()->query()) ensures your filters stay active when clicking page 2, 3, etc. --}}
                {{ $logs->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
@endsection