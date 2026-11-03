@if ($olimpiade && $olimpiade->url)
    <x-download-button href="{{ $this->getPresignedUrl(ltrim(parse_url($olimpiade->url, PHP_URL_PATH), '/')) }}">Unduh</x-download-button>
@endif
