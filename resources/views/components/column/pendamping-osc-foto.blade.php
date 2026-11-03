<div>
    @if ($row->getPendampingOsc() && $row->getPendampingOsc()->foto_pendamping)
        <div class="flex items-center space-x-2">
            <!-- Thumbnail foto -->
            <img src="{{ asset('storage/' . $row->getPendampingOsc()->foto_pendamping) }}" 
                 alt="Foto Pendamping" 
                 class="w-20 h-24 object-cover rounded-lg border border-gray-200 cursor-pointer"
                 onclick="showImagePreview('{{ asset('storage/' . $row->getPendampingOsc()->foto_pendamping) }}', '{{ $row->getPendampingOsc()->nama_pendamping }}')" />
        </div>
    @else
        -
    @endif
</div>

<!-- Image Preview Modal -->
<script>
function showImagePreview(imageUrl, name) {
    // Remove existing modal if any
    const existingModal = document.getElementById('imagePreviewModal');
    if (existingModal) {
        existingModal.remove();
    }
    
    // Create modal with background
    const modalHtml = `
        <div id="imagePreviewModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" onclick="closeImagePreview()"></div>

                <!-- Modal panel -->
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-auto">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="text-center">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                                ${name}
                            </h3>
                            <div class="flex justify-center">
                                <img src="${imageUrl}" 
                                     alt="Foto ${name}" 
                                     class="rounded-lg shadow-lg" 
                                     style="max-height: 400px; max-width: 90vw;" />
                            </div>
                        </div>
                    </div>
                    <div class="bg-primaryPoi25 px-4 py-3 sm:px-6 text-center">
                        <button type="button" 
                                onclick="closeImagePreview()" 
                                class="inline-flex justify-center rounded-md shadow-sm px-4 py-2 bg-secondaryPoi24-700 text-base font-medium text-white hover:bg-secondaryPoi24-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    document.body.insertAdjacentHTML('beforeend', modalHtml);
    
    // Prevent body scroll
    document.body.style.overflow = 'hidden';
}

function closeImagePreview() {
    const modal = document.getElementById('imagePreviewModal');
    if (modal) {
        modal.remove();
    }
    
    // Restore body scroll
    document.body.style.overflow = '';
}

// Close modal with ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImagePreview();
    }
});
</script>