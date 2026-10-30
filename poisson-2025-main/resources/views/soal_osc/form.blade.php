<div>
    <form wire:submit.prevent="storeSoal" x-cloak>
        <div class="text-sm text-gray-800">
            <!-- Paket Soal -->
            <div class="mb-4">
                <label class="block pr-4 mb-1 font-bold text-gray-800 md:mb-0" for="package">Paket Soal</label>
                <select id="package" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600" wire:model.defer="package">
                    <option value="">Pilih opsi paket</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </select>
                <div>
                    <x-input-error for="package" class="mt-2" />
                </div>
            </div>

            <!-- Question -->
            <div class="mb-4">
                <label class="block pr-4 mb-1 font-bold text-gray-800 md:mb-0" for="question">Soal</label>
                <div wire:ignore>
                    <x-textarea id="question" type="text" class="block w-full mt-1 editor" wire:model.defer="question" autocomplete="question" />
                </div>
                <div>
                    <x-input-error for="question" class="mt-2" />
                </div>
            </div>

            <!-- Option A -->
            <div class="mb-4">
                <label class="block pr-4 mb-1 font-bold text-gray-800 md:mb-0" for="option_a">Opsi A</label>
                <x-input id="option_a" type="text" class="block w-full mt-1" wire:model.defer="option_a" autocomplete="option_a" />
                <div>
                    <x-input-error for="option_a" class="mt-2" />
                </div>
            </div>

            <!-- Option B -->
            <div class="mb-4">
                <label class="block pr-4 mb-1 font-bold text-gray-800 md:mb-0" for="option_b">Opsi B</label>
                <x-input id="option_b" type="text" class="block w-full mt-1" wire:model.defer="option_b" autocomplete="option_b" />
                <div>
                    <x-input-error for="option_b" class="mt-2" />
                </div>
            </div>

            <!-- Option C -->
            <div class="mb-4">
                <label class="block pr-4 mb-1 font-bold text-gray-800 md:mb-0" for="option_c">Opsi C</label>
                <x-input id="option_c" type="text" class="block w-full mt-1" wire:model.defer="option_c" autocomplete="option_c" />
                <div>
                    <x-input-error for="option_c" class="mt-2" />
                </div>
            </div>

            <!-- Option D -->
            <div class="mb-4">
                <label class="block pr-4 mb-1 font-bold text-gray-800 md:mb-0" for="option_d">Opsi D</label>
                <x-input id="option_d" type="text" class="block w-full mt-1" wire:model.defer="option_d" autocomplete="option_d" />
                <div>
                    <x-input-error for="option_d" class="mt-2" />
                </div>
            </div>

            <!-- Option Key -->
            <div class="mb-4">
                <label class="block pr-4 mb-1 font-bold text-gray-800 md:mb-0" for="option_key">Kunci Opsi</label>
                <select id="option_key" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600" wire:model.defer="option_key">
                    <option value="">Pilih opsi kunci</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
                <div>
                    <x-input-error for="option_key" class="mt-2" />
                </div>
            </div>

            <!-- Type -->
            {{-- <div class="mb-4">
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3">
                                <label class="block pr-4 mb-1 font-bold text-gray-800 md:mb-0" for="type">Tipe</label>
                            </div>

                                <select id="type"
                            -gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                                    wire:model.defer="type">
                                    <option value="">Pilih tipe soal</option>
                                    <option value="penyisihan">Penyisihan</option>
                                </select>
                            </div>
                        </div>
                        <div>

                                <x-input-error for="type" class="mt-2" />

                        </div>
                    </div> --}}
            <!-- Alternatif Type -->
            {{-- <div class="mb-4">
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3">
                                <label class="block pr-4 mb-1 font-bold text-gray-800 md:mb-0" for="type">Tipe</label>
                            </div>

                                <x-input id="type" type="text" class="block w-full mt-1" wire:model.defer="type"
                            " placeholder="penyisihan" disabled/>
                            </div>
                        </div>
                        <div>

                                <x-input-error for="type" class="mt-2" />

                        </div>
                    </div> --}}

            {{-- Rifqi : sesuaikan dengan poin benar, salah, dan kosong. Pada bagian input ini dihilangkan karna semua soal memiliki nilai yang sama  --}}
            <!-- Poin Benar -->
            {{-- <div class="mb-4">
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3">
                                <label class="block pr-4 mb-1 font-bold text-gray-800 md:mb-0" for="correct_point">Poin Benar</label>
                            </div>

                                <x-input id="correct_point" type="number" class="block w-full mt-1" wire:model.defer="correct_point"
                            " min="0" max="100" placeholder="3" disabled/>
                            </div>
                        </div>
                        <div>

                                <x-input-error for="correct_point" class="mt-2"/>

                        </div>
                    </div> --}}

            <!-- Poin Salah -->
            {{-- <div class="mb-4">
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3">
                                <label class="block pr-4 mb-1 font-bold text-gray-800 md:mb-0" for="wrong_point">Poin Salah</label>
                            </div>

                                <x-input id="wrong_point" type="number" class="block w-full mt-1" wire:model.defer="wrong_point"
                            " placeholder="-1" disabled/>
                            </div>
                        </div>
                        <div>

                                <x-input-error for="wrong_point" class="mt-2" />

                        </div>
                    </div> --}}

            <!-- Poin Kosong-->
            {{-- <div class="mb-4">
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/3">
                                <label class="block pr-4 mb-1 font-bold text-gray-800 md:mb-0" for="blank_point">Poin Kosong</label>
                            </div>

                                <x-input id="blank_point" type="number" class="block w-full mt-1" wire:model.defer="blank_point"
                            " placeholder="0" disabled/>
                            </div>
                        </div>
                        <div>

                                <x-input-error for="blank_point" class="mt-2" />

                        </div>
                    </div> --}}
        </div>
        <div class="flex justify-end">
            <x-button wire:loading.attr="disabled">Simpan</x-button>
        </div>
    </form>
</div>

@push('styles')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
@endpush

@push('scripts')
<script type="text/javascript">
    document.addEventListener('livewire:load', function () {
        $('#question').summernote({
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('question', contents);
                }
            }
        });
    });
</script>
@endpush
