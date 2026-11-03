<x-guest-layout>
    <x-authentication-card>
        <div class="mb-4 text-sm text-primaryPoi25-600">
            {{ __('auth.lupa-password.message') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('auth.lupa-password.resend-email') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
