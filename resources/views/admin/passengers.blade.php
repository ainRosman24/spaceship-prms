@extends('layouts.app')

@section('content')
<div class="container text-white">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Crew Lead Command Center</h2>
        <span class="text-muted">Live System Oversight</span>
    </div>

    @include('admin.partials.tabs')

    <div class="card bg-dark border-secondary">
        <div class="card-header bg-secondary fw-bold text-white d-flex justify-content-between align-items-center">
            <span>Passenger Roster & Tier Management</span>
            <button type="button" class="btn btn-sm btn-outline-info fw-bold" style="color: #ff9999; border-color: #ff3333;" data-bs-toggle="modal" data-bs-target="#createPassengerModal">
                + Provision Passenger
            </button>
        </div>
        <div class="card-body p-0 table-responsive">
            <table class="table table-dark table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Passenger Name</th>
                        <th>Current Tier</th>
                        <th class="pe-4 text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($passengers as $passenger)
                        <tr>
                            <td class="align-middle ps-4 text-muted">P-{{ str_pad($passenger->id, 3, '0', STR_PAD_LEFT) }}</td>
                            <td class="align-middle fw-medium">{{ $passenger->name }}</td>
                            <td class="align-middle">
                                <span class="badge bg-secondary border border-secondary">{{ $passenger->tier->name ?? 'Unassigned' }}</span>
                            </td>
                            <td class="pe-4 text-end d-flex justify-content-end">
                                <form method="POST" action="{{ route('admin.users.update_tier', $passenger->id) }}" class="d-flex me-2">
                                    @csrf
                                    @method('PATCH')
                                    <select name="tier_id" class="form-select form-select-sm bg-dark text-white border-secondary me-1" style="width: auto;">
                                        @foreach($tiers as $tier)
                                            <option value="{{ $tier->id }}" {{ $passenger->tier_id == $tier->id ? 'selected' : '' }}>
                                                {{ $tier->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-outline-warning">Update</button>
                                </form>

                                <form method="POST" action="{{ route('admin.users.destroy', $passenger->id) }}" onsubmit="return confirm('Confirm decommission of passenger profile?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">X</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create Passenger Modal -->
<div class="modal fade" id="createPassengerModal" tabindex="-1" data-bs-theme="dark">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white border-secondary">
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <div class="modal-header border-secondary">
                    <h5 class="modal-title fw-bold">Provision Passenger Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-white-50 text-uppercase fw-bold small">Full Name</label>
                        <input type="text" name="name" class="form-control bg-dark text-white border-secondary" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-white-50 text-uppercase fw-bold small">Email Address (System ID)</label>
                        <input type="email" name="email" class="form-control bg-dark text-white border-secondary" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-white-50 text-uppercase fw-bold small">Temporary Access Code</label>
                        <input type="password" name="password" class="form-control bg-dark text-white border-secondary" required minlength="8">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-white-50 text-uppercase fw-bold small">Initial Tier Assignment</label>
                        <select name="tier_id" class="form-select bg-dark text-white border-secondary" required>
                            @foreach($tiers as $tier)
                                <option value="{{ $tier->id }}">{{ $tier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-bold">Initialize Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection