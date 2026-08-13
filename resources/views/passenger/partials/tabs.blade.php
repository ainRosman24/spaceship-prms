<ul class="nav nav-tabs border-secondary mb-4">
    <li class="nav-item">
        <a href="{{ route('passenger.dashboard') }}" 
           class="nav-link fw-bold {{ request()->routeIs('passenger.dashboard') ? 'active bg-dark text-white border-secondary border-bottom-0' : 'text-muted border-0' }}">
            Access Terminal
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('passenger.history') }}" 
           class="nav-link fw-bold {{ request()->routeIs('passenger.history') ? 'active bg-dark text-white border-secondary border-bottom-0' : 'text-muted border-0' }}">
            Usage History
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('passenger.tier') }}" 
           class="nav-link fw-bold {{ request()->routeIs('passenger.tier') ? 'active bg-dark text-white border-secondary border-bottom-0' : 'text-muted border-0' }}">
            Tier Packages
        </a>
    </li>
</ul>