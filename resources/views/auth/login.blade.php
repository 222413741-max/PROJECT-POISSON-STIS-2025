<x-guest-layout>
    <x-authentication-card>
        <!-- Validation Errors -->
        <x-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    placeholder="Email" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" placeholder="{{ __('auth.Kata Sandi') }}" />
            </div>

            <div class="mt-2">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-primaryPoi25-600 hover:text-primaryPoi25-700"
                        href="{{ route('password.request') }}">
                        {{ __('auth.Lupa Kata Sandi?') }}
                    </a>
                @endif
            </div>

            <!-- Remember Me -->
            <div class="block mt-2">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-primaryPoi25-600">{{ __('auth.Ingat saya') }}</span>
                </label>
            </div>

            <x-button class="w-full mt-4">
                {{ __('auth.Masuk') }}
            </x-button>
            <div class="text-primaryPoi25-600 text-sm mt-2">
                {{ __('auth.Belum memiliki akun?') }} <a href="{{ route('register') }}"
                    class="hover:text-primaryPoi25-700 underline font-bold">{{ __('auth.Daftar sekarang') }}</a>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
