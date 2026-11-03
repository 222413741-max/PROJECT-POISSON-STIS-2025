@props(['country' => 'en'])

<img src="{{ asset('img/' . strtolower($country) . '.png') }}" alt="Country Flag" class="h-[20px] w-[30px]"
  style="box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);">
