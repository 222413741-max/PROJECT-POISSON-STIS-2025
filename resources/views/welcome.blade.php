<x-landing-page-layout>
    @if (Route::has('login'))
        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
        @endif
    @endif
</x-landing-page-layout>
