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
            <span>Ship Facilities Configuration</span>
            <button type="button" class="btn btn-sm btn-outline-info fw-bold" style="color: #ff9999; border-color: #ff3333;" data-bs-toggle="modal" data-bs-target="#createResourceModal">
                + Provision Facility
            </button>
        </div>
        <div class="card-body p-0 table-responsive">
            <table class="table table-dark table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Facility Name</th>
                        <th>Minimum Tier Required</th>
                        <th class="pe-4 text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($resources as $resource)
                        <tr>
                            <td class="align-middle ps-4 text-white fw-bold">{{ $resource->name }}</td>
                            <td class="align-middle text-muted">Level {{ $resource->min_tier_weight }}</td>
                            <td class="pe-4 text-end">
                                <form method="POST" action="{{ route('admin.resources.destroy', $resource->id) }}" onsubmit="return confirm('Confirm decommission of ship facility?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Decommission</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create Resource Modal -->
<div class="modal fade" id="createResourceModal" tabindex="-1" data-bs-theme="dark">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white border-secondary">
            <form method="POST" action="{{ route('admin.resources.store') }}">
                @csrf
                <div class="modal-header border-secondary">
                    <h5 class="modal-title fw-bold">Provision Ship Facility</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-white-50 text-uppercase fw-bold small">Facility Name</label>
                        <input type="text" name="name" class="form-control bg-dark text-white border-secondary" required placeholder="e.g., Zero-G Gym">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-white-50 text-uppercase fw-bold small">Minimum Required Tier Weight</label>
                        <select name="min_tier_weight" class="form-select bg-dark text-white border-secondary" required>
                            <option value="1">1 (Silver Base)</option>
                            <option value="2">2 (Gold Enhanced)</option>
                            <option value="3">3 (Platinum VIP)</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-bold">Deploy Facility</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection