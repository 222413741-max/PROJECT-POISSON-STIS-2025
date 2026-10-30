<div class="flex space-x-2">
    @if ($row->getPendampingOsc())
       <x-button onclick="confirmDelete({{ $row->getPendampingOsc()->id }})" 
                 color="bg-red-600">
           Reset Data
       </x-button>
    @else
        <x-badges.error name="Belum Upload" />
    @endif
</div>

<script>
function confirmDelete(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data pendamping ini?')) {
        @this.delete(id);
    }
}
</script>