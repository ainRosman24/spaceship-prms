<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="forgot-password-title">Forgot Password</h2>
        <p class="forgot-password-subtitle">Enter your email to reset your password</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-section">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-100" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="button-container">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>

    <div class="back-link-container">
        <a href="{{ route('login') }}" class="back-link">
            ← {{ __('Back to Login') }}
        </a>
    </div>
</x-guest-layout>