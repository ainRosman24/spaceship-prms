@extends('layouts.app')

@section('content')

<div class="container text-white">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Passenger Terminal</h2>
        <span class="text-muted">Clearance: <span
                class="badge bg-secondary border border-secondary">{{ $user->tier->name ?? 'Unassigned' }}</span></span>
    </div>

    <!-- Include the clickable tabs -->
    @include('passenger.partials.tabs')

    <!-- PACKAGE INFORMATION CONTENT -->
    <div class="card bg-dark border-secondary mb-4 shadow-sm">
        <div class="card-body p-4">
            <div class="row g-4 mt-1">

                <!-- SILVER PACKAGE -->
                <div class="col-md-4">
                    <div class="tier-card tier-silver p-4 h-100 d-flex flex-column align-items-center text-center" style="--card-color: #94a3b8;">
                        
                        <!-- Holographic Badge -->
                        <div class="position-relative mb-4 tier-badge-container" style="width: 110px; height: 110px;">
                            <div class="position-absolute w-100 h-100 rounded-circle hologram-ring"></div>
                            <div class="position-absolute top-50 start-50 translate-middle rounded-circle d-flex justify-content-center align-items-center tier-image-wrapper overflow-hidden" style="width: 85px; height: 85px;">
                                <span style="font-size: 2.5rem; font-weight: 900; color: var(--card-color); text-shadow: 0 0 15px var(--card-color);">
                                    S
                                </span>
                            </div>
                        </div>

                        <h2 class="fw-bold mb-1 text-uppercase" style="color: var(--card-color); letter-spacing: 2px;">SILVER</h2>
                        <p class="text-muted mb-4 small fw-bold">BASE TIER ACCESS</p>

                        <hr class="border-secondary mb-3 w-100 mx-auto" style="opacity: 0.3;">

                        <h6 class="text-white fw-bold mb-3">Approved Resources:</h6>
                        <ul class="text-white-50 list-unstyled text-start w-100 px-3" style="font-size: 0.95rem;">
                            <li class="mb-2 d-flex align-items-center"><span class="me-2" style="color: var(--card-color);">&bull;</span> Food Stations</li>
                            <li class="mb-2 d-flex align-items-center"><span class="me-2" style="color: var(--card-color);">&bull;</span> Sleeping Pods</li>
                            <li class="mb-2 d-flex align-items-center"><span class="me-2" style="color: var(--card-color);">&bull;</span> Basic Hygiene</li>
                        </ul>
                    </div>
                </div>

                <!-- GOLD PACKAGE -->
                <div class="col-md-4">
                    <div class="tier-card tier-gold p-4 h-100 d-flex flex-column align-items-center text-center" style="--card-color: #f59e0b;">
                        
                        <!-- Holographic Badge -->
                        <div class="position-relative mb-4 tier-badge-container" style="width: 110px; height: 110px;">
                            <div class="position-absolute w-100 h-100 rounded-circle hologram-ring"></div>
                            <div class="position-absolute top-50 start-50 translate-middle rounded-circle d-flex justify-content-center align-items-center tier-image-wrapper overflow-hidden" style="width: 85px; height: 85px;">
                                <span style="font-size: 2.5rem; font-weight: 900; color: var(--card-color); text-shadow: 0 0 15px var(--card-color);">
                                    G
                                </span>
                            </div>
                        </div>

                        <h2 class="fw-bold mb-1 text-uppercase" style="color: var(--card-color); letter-spacing: 2px;">GOLD</h2>
                        <p class="text-muted mb-4 small fw-bold">ENHANCED ACCESS</p>

                        <hr class="border-secondary mb-3 w-100 mx-auto" style="opacity: 0.3;">

                        <h6 class="text-white fw-bold mb-3">Approved Resources:</h6>
                        <ul class="text-white-50 list-unstyled text-start w-100 px-3" style="font-size: 0.95rem;">
                            <li class="mb-2 d-flex align-items-center"><span class="me-2" style="color: var(--card-color);">&bull;</span> Private Cabins</li>
                            <li class="mb-2 d-flex align-items-center"><span class="me-2" style="color: var(--card-color);">&bull;</span> Adv. Medical Bay</li>
                            <li class="text-white fw-bold mt-3 border-top border-secondary pt-2">+ All Silver Facilities</li>
                        </ul>
                    </div>
                </div>

                <!-- PLATINUM PACKAGE -->
                <div class="col-md-4">
                    <div class="tier-card tier-platinum p-4 h-100 d-flex flex-column align-items-center text-center" style="--card-color: #ff3333;">
                        
                        <!-- Holographic Badge -->
                        <div class="position-relative mb-4 tier-badge-container" style="width: 110px; height: 110px;">
                            <div class="position-absolute w-100 h-100 rounded-circle hologram-ring"></div>
                            <div class="position-absolute top-50 start-50 translate-middle rounded-circle d-flex justify-content-center align-items-center tier-image-wrapper overflow-hidden" style="width: 85px; height: 85px;">
                                <span style="font-size: 2.5rem; font-weight: 900; color: var(--card-color); text-shadow: 0 0 15px var(--card-color);">
                                    P
                                </span>
                            </div>
                        </div>

                        <h2 class="fw-bold mb-1 text-uppercase" style="color: var(--card-color); letter-spacing: 2px;">PLATINUM</h2>
                        <p class="text-muted mb-4 small fw-bold">FULL SHIP ACCESS</p>

                        <hr class="border-secondary mb-3 w-100 mx-auto" style="opacity: 0.3;">

                        <h6 class="text-white fw-bold mb-3">Approved Resources:</h6>
                        <ul class="text-white-50 list-unstyled text-start w-100 px-3" style="font-size: 0.95rem;">
                            <li class="mb-2 d-flex align-items-center"><span class="me-2" style="color: var(--card-color);">&bull;</span> Luxury O2 Pods</li>
                            <li class="mb-2 d-flex align-items-center"><span class="me-2" style="color: var(--card-color);">&bull;</span> VIP Rec Deck</li>
                            <li class="text-white fw-bold mt-3 border-top border-secondary pt-2">+ All Gold & Silver</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection