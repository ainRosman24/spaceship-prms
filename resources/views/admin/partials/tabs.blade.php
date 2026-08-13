<ul class="nav nav-tabs border-secondary mb-4 gap-2">
    <li class="nav-item">
        <a href="{{ route('admin.dashboard') }}" 
           class="nav-link fw-bold {{ request()->routeIs('admin.dashboard') ? 'active bg-dark text-white border-secondary border-bottom-0' : 'text-muted border-0' }}">
            📊 Statistics
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.passengers') }}" 
           class="nav-link fw-bold {{ request()->routeIs('admin.passengers') ? 'active bg-dark text-white border-secondary border-bottom-0' : 'text-muted border-0' }}">
            👥 Passenger Management
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.resources') }}" 
           class="nav-link fw-bold {{ request()->routeIs('admin.resources') ? 'active bg-dark text-white border-secondary border-bottom-0' : 'text-muted border-0' }}">
            🚀 Ship Facilities
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.logs') }}" 
           class="nav-link fw-bold {{ request()->routeIs('admin.logs') ? 'active bg-dark text-white border-secondary border-bottom-0' : 'text-muted border-0' }}">
            🛡️ System Logs
        </a>
    </li>
</ul>

<!-- Shared System Alerts -->
@if (session('success'))
    <div class="alert alert-success bg-success bg-opacity-25 text-success border border-success fw-bold shadow-sm mb-4">
        {{ session('success') }}
    </div>
@endif