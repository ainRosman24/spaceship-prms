@extends('layouts.app')

@section('content')

<!-- Dedicated Styles for the Holographic Image Badge -->
@php
    // Determine dynamic colors and initials based on the user's tier
    $tierName = strtolower($user->tier->name ?? 'none');
    $tierColors = [
        'silver' => '#94a3b8', // Slate Gray
        'gold' => '#f59e0b',   // Amber Gold
        'platinum' => '#ff3333' // Mars Red
    ];
    $tierColor = $tierColors[$tierName] ?? '#475569';
    $tierInitial = strtoupper(substr($user->tier->name ?? 'U', 0, 1));
@endphp

<div class="container text-white" style="--tier-color: {{ $tierColor }};">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Passenger Terminal</h2>
    </div>

    <!-- Include the clickable tabs -->
    @include('passenger.partials.tabs')

    <!-- RESOURCE DISCOVERY CONTENT -->
    <div class="row align-items-stretch">
        
        <!-- UPGRADED: CURRENT PACKAGE DISPLAY WITH IMAGE -->
        <div class="col-md-4 mb-4">
            <div class="card border-secondary shadow-sm h-100 tier-card" style="border-color: var(--tier-color) !important; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
                <div class="card-header bg-secondary fw-bold text-white text-center py-3" style="border-bottom: 1px solid var(--tier-color);">
                    Current Package
                </div>
                <div class="card-body p-4 text-center d-flex flex-column justify-content-center align-items-center">
                    
                    <!-- THE FANCY HOLOGRAPHIC IMAGE CONTAINER -->
                    <div class="position-relative mb-4 tier-badge-container" style="width: 150px; height: 150px;">
                        
                        <!-- Spinning Outer Glow Ring -->
                        <div class="position-absolute w-100 h-100 rounded-circle hologram-ring"></div>
                        
                        <!-- Inner Image/Icon Wrapper -->
                        <div class="position-absolute top-50 start-50 translate-middle rounded-circle d-flex justify-content-center align-items-center tier-image-wrapper overflow-hidden" style="width: 120px; height: 120px;">
                            
                            <!-- 
                                IF YOU HAVE REAL IMAGES: 
                                Uncomment the <img> tag below and place files like "tier-platinum.png" in your public/images folder.
                            -->
                            <!-- <img src="{{ asset('images/tier-' . $tierName . '.png') }}" alt="Tier Image" class="w-100 h-100" style="object-fit: cover;"> -->
                            
                            <!-- FALLBACK: Holographic CSS Letter (Visible if img is commented out) -->
                            <span style="font-size: 3.5rem; font-weight: 900; color: var(--tier-color); text-shadow: 0 0 15px var(--tier-color);">
                                {{ $tierInitial }}
                            </span>
                            
                        </div>
                    </div>

                    <!-- Dynamic Tier Text -->
                    <h3 class="fw-bold mb-0 text-uppercase" style="color: var(--tier-color); letter-spacing: 3px; text-shadow: 0 0 10px rgba(255,255,255,0.1);">
                        {{ $user->tier->name ?? 'Unassigned' }}
                    </h3>
                    <p class="text-white-50 small mt-2 mb-4 fw-bold" style="letter-spacing: 1px;">
                        CLEARANCE LEVEL {{ $user->tier->weight ?? 0 }}
                    </p>
                    
                    <hr class="border-secondary mb-4 w-100 mx-auto" style="opacity: 0.3;">
                    
                    <p class="text-white-50 mb-0">
                        Your package grants you secure access to 
                        <strong class="text-white fs-5 mx-1">{{ $allowedResources->count() }}</strong> 
                        ship facilities.
                    </p>
                </div>
            </div>
        </div>

        <!-- SCANNER INTERFACE -->
        <div class="col-md-8 mb-4">
            <div class="card bg-dark border-secondary shadow-sm h-100">
                <div class="card-header bg-secondary fw-bold text-white text-center py-3">
                    Resource Discovery Scanner
                </div>
                <div class="card-body p-4 text-center d-flex flex-column justify-content-center">
                    
                    @if (session('success'))
                        <div class="alert alert-success bg-success bg-opacity-25 text-success border border-success fw-bold">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if (session('error'))
                        <div class="alert alert-danger bg-danger bg-opacity-25 text-danger border border-danger fw-bold">
                            {{ session('error') }}
                        </div>
                    @endif

                    <p class="text-muted mb-4">Select a facility from your approved package list to request access.</p>
                    
                    <form method="POST" action="{{ route('resource.access') }}" class="w-100">
                        @csrf
                        <div class="mb-4">
                            <select name="resource_id" class="form-select form-select-lg text-center fw-bold border-secondary" style="background-color: #0f172a; color: #ffffff;" required>
                                <option value="" style="background-color: #060913; color: #94a3b8;" disabled selected>-- SELECT FACILITY --</option>
                                
                                @foreach($resources as $resource)
                                    <option value="{{ $resource->id }}" style="background-color: #0f172a; color: #ffffff;">
                                        {{ $resource->name }}
                                    </option>
                                @endforeach
                                
                            </select>
                        </div>
                        <button type="submit" class="btn btn-lg btn-primary px-5 fw-bold" style="letter-spacing: 2px;">
                            SCAN ID
                        </button>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection