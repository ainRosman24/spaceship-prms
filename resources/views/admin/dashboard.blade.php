@extends('layouts.app')

@section('content')
<div class="container text-white">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Crew Lead Command Center</h2>
        <span class="text-muted">Live System Oversight</span>
    </div>

    @include('admin.partials.tabs')

    <!-- STATISTICS CONTENT (Updated for animations) -->
    <div class="row">
        <!-- Total Interactions -->
        <div class="col-md-4 mb-4">
            <div class="card bg-dark border-secondary h-100 shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-primary bg-opacity-25 p-3 me-3 border border-primary">
                        <h4 class="mb-0 text-primary">📊</h4>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Total Interactions</h6>
                        <!-- Added counter-value class and data-target attribute -->
                        <h3 class="mb-0 fw-bold text-white counter-value" data-target="{{ $totalInteractions }}">0</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Highest Demand Facility -->
        <div class="col-md-4 mb-4">
            <div class="card bg-dark border-secondary h-100 shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-warning bg-opacity-25 p-3 me-3 border border-warning">
                        <h4 class="mb-0 text-warning">🔥</h4>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Highest Demand Facility</h6>
                        <h3 class="mb-0 fw-bold text-white fs-5">{{ $topResource ? $topResource->resource->name : 'N/A' }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Blocked Access Attempts -->
        <div class="col-md-4 mb-4">
            <div class="card bg-dark border-secondary h-100 shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-danger bg-opacity-25 p-3 me-3 border border-danger">
                        <h4 class="mb-0 text-danger">🛡️</h4>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Blocked Access Attempts</h6>
                        <!-- Added counter-value class and data-target attribute -->
                        <h3 class="mb-0 fw-bold text-white counter-value" data-target="{{ $deniedRequests }}">0</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Bar Chart: Resource Utilization -->
        <div class="col-md-8 mb-4">
            <div class="card bg-dark border-secondary h-100 shadow-sm">
                <div class="card-header bg-secondary fw-bold text-white">
                    Facility Utilization Analytics
                </div>
                <div class="card-body">
                    <canvas id="resourceChart" height="100"></canvas>
                </div>
            </div>
        </div>

        <!-- Doughnut Chart: Access Matrix -->
        <div class="col-md-4 mb-4">
            <div class="card bg-dark border-secondary h-100 shadow-sm">
                <div class="card-header bg-secondary fw-bold text-white">
                    Access Authorization Matrix
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <canvas id="statusChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Script ONLY loads on this page -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Chart.defaults.color = '#94a3b8';
        Chart.defaults.font.family = "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif";

        const ctxResource = document.getElementById('resourceChart').getContext('2d');
        new Chart(ctxResource, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Total Scans',
                    data: {!! json_encode($chartData) !!},
                    backgroundColor: '#ff3333',
                    borderColor: '#b30000',
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#334155' } },
                    x: { grid: { display: false } }
                }
            }
        });

        const ctxStatus = document.getElementById('statusChart').getContext('2d');
        new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: ['Granted', 'Denied'],
                datasets: [{
                    data: [{{ $grantedRequests }}, {{ $deniedRequests }}],
                    backgroundColor: ['#198754', '#dc3545'],
                    borderColor: '#1e293b',
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                cutout: '70%',
                plugins: { legend: { position: 'bottom', labels: { padding: 20 } } }
            }
        });
    });
</script>
@endsection