<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <!-- Updated Icon Background to Mars Red -->
            <span class="text-white rounded-circle me-2 d-inline-flex align-items-center justify-content-center fw-bold"
                style="background-color: #ff3333; width: 32px; height: 32px; font-size: 1rem;">X</span>
            26 <span class="brand-accent ms-1">PRMS</span>
        </a>

        <button class="navbar-toggler border-secondary bg-dark" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="navbar-nav me-auto ms-4">
                @auth
                    <!-- Dynamic Links Based on Role with Active State Highlighting -->
                    @if(auth()->user()->isCrewLead())
                        <div class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                                href="{{ route('admin.dashboard') }}">
                                Command Center
                            </a>
                        </div>
                    @else
                        <div class="nav-item">
                            <a class="nav-link {{ request()->routeIs('passenger.dashboard') ? 'active' : '' }}"
                                href="{{ route('passenger.dashboard') }}">
                                Passenger Terminal
                            </a>
                        </div>
                    @endif
                @endauth
            </div>

            @auth
                <div class="d-flex align-items-center mt-3 mt-lg-0">
                    <div class="user-badge me-3 text-white">
                        <span class="fw-bold">{{ auth()->user()->name }}</span>
                        @if(auth()->user()->tier)
                            <span
                                class="badge bg-secondary ms-2 border border-secondary">{{ auth()->user()->tier->name }}</span>
                        @endif
                        @if(auth()->user()->isCrewLead())
                            <span class="badge bg-danger ms-2">ADMIN</span>
                        @endif
                    </div>

                    <div class="d-flex gap-2 m-0">
                        <!-- Profile Link -->
                        <a href="{{ route('profile.show') }}" class="btn btn-outline-info btn-sm fw-bold" style="color: #ff9999; border-color: #ff3333;">Profile</a>
                        <!-- Logout Form -->
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary btn-sm fw-bold">Logout</button>
                        </form>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</nav>