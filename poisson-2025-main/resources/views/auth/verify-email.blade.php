<x-guest-layout>
    <x-authentication-card>
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-300">
            {{ __('auth.konfirmasi.message') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('auth.konfirmasi.submessage') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button type="submit">
                        {{ __('auth.konfirmasi.resend-email') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                    class="underline text-sm font-semibold text-primaryPoi25-600 hover:text-primaryPoi25-700 ">
                    {{ __('auth.Keluar') }}
                </button>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
