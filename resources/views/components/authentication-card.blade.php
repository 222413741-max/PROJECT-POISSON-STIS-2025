<div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0">
    <!-- Authentication Card -->
    <div class="w-full sm:max-w-lg bg-white shadow-2xl rounded-2xl px-8 py-10 flex flex-col items-center">

        <!-- Logo + POISSON 2025 + Subtitle -->
        <div class="flex flex-row items-center mb-6">
            <a href="/">
                <img src="{{ asset('img/logo-2025-icon.png') }}" alt="" width="100">
            </a>
            <div class="flex flex-col ml-3">
                <a href="/">
                    <span class="text-3xl font-extrabold text-primaryPoi25-600" 
                          style="font-family: 'Playfair Display SC', sans-serif;">
                        POISSON
                    </span>
                </a>
                <p class="text-sm text-primaryPoi25-600 font-medium mt-1">
                    Statistics Competition 2025
                </p>
            </div>
        </div>

        <!-- Slot form / input -->
        <div class="w-full mt-6">
            {{ $slot }} <!-- slot ini berisi input-input login/register -->
        </div>
    </div>
</div>
