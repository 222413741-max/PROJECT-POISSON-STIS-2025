@php
    $paymentTitle = 'Notifikasi Pembayaran';
    $type = null;
    $message = '';
    $hasPaymentNotification = session()->has('payment_notification');
    
    if($hasPaymentNotification) {
        [$type, $message] = explode('|', session('payment_notification'), 2);
        
        $paymentTitle = match($type) {
            'success' => 'Pembayaran Berhasil!',
            'info' => 'Pembayaran Pending',
            default => 'Pembayaran Gagal'
        };
        
        // Clear session after reading
        session()->forget('payment_notification');
    }
@endphp

@if($hasPaymentNotification)
<div x-data="{ open: true }" x-show="open" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
    <!-- Backdrop -->
    <div 
        x-show="open" 
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"
        @click="open = false">
    </div>

    <!-- Modal Container -->
    <div class="flex min-h-screen items-center justify-center p-4">
        <div 
            x-show="open"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative transform overflow-hidden rounded-lg bg-primaryPoi25 shadow-2xl transition-all w-full max-w-sm">
            


            <!-- Modal Content -->
            <div class="text-center px-6 py-8">
                <!-- Icon -->
                <div class="mb-6">
                    @if($type == 'success')
                        <div class="w-16 h-16 mx-auto bg-white rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    @elseif($type == 'info')
                        <div class="w-16 h-16 mx-auto bg-white rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    @else
                        <div class="w-16 h-16 mx-auto bg-white rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Title -->
                <h3 class="text-xl font-semibold text-white mb-4">
                    {{ $paymentTitle }}
                </h3>
                
                <!-- Message -->
                <p class="text-white/90 text-md leading-relaxed mb-8 whitespace-pre-line">
                    {{ $message }}
                </p>

                <!-- Button -->
                <button 
                    @click="open = false"
                    class="w-full bg-white hover:bg-gray-50 text-primaryPoi25 font-medium py-3 px-6 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-primaryPoi25">
                    OK
                </button>
            </div>
        </div>
    </div>
</div>
@endif

{{-- Auto-close after 10 seconds (optional) --}}
@if($hasPaymentNotification)
<script>
    // Optional: Auto close after 10 seconds
    setTimeout(function() {
        const modal = document.querySelector('[x-data*="open: true"]');
        if (modal && modal.__x) {
            modal.__x.$data.open = false;
        }
    }, 10000);
</script>
@endif