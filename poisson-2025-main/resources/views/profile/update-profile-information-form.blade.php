<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('dashboard.Informasi Profil') }}
    </x-slot>

    <x-slot name="description">
        {{ __('dashboard.Halaman untuk mengubah profil pengguna.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden" wire:model="photo" x-ref="photo" x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('Foto') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                        class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                        x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 mr-2 dark:bg-primaryPoisson dark:text-gray-300 dark:border-dark" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('dashboard.Perbarui foto profil') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('dashboard.Hapus foto profil') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('dashboard.nama') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name"
                autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-input-error for="email" class="mt-2" />
        </div>

        <!-- Jenis Sekolah -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="university_tipe" value="{{ __('dashboard.Tipe Akun') }}" />
            <x-select class="mt-1 block w-full" id="university_tipe" wire:model="state.university_tipe">
                <option value="">-- {{ __('dashboard.Pilih Tipe Sekolah') }} --</option>
                <option value="0">{{ __('dashboard.universitas') }}</option>
                <option value="2">{{ __('dashboard.universitas_luar') }}</option>
                <option value="1">{{ __('dashboard.SMA') }}</option>
            </x-select>
            <x-input-error for="university_tipe" class="mt-2" />
        </div>

        <!-- Asal Perguruan Tinggi -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="college" value="{{ __('dashboard.Universitas / Sekolah') }}" />
            <x-input id="college" type="text" class="mt-1 block w-full" wire:model.defer="state.college" />
            <x-input-error for="college" class="mt-2" />
        </div>

        <!-- School Logo Upload -->
        <div x-data="{logoName: null, logoPreview: null, schoolType: @entangle('state.university_tipe')}" class="col-span-6 sm:col-span-4">
            <!-- School Logo File Input -->
            <input type="file" class="hidden" wire:model.defer="state.school_logo" x-ref="schoolLogo" x-on:change="
                                    logoName = $refs.schoolLogo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        logoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.schoolLogo.files[0]);
                            " />

            <x-label for="school_logo" 
                     x-text="schoolType == '1' ? '{{ __('dashboard.Logo SMA') }}' : '{{ __('dashboard.Logo Universitas') }}'" />

            <!-- Current School Logo -->
            <div class="mt-2" x-show="! logoPreview">
                <img src="{{ $this->user->school_logo_url }}" alt="School Logo" class="h-40 w-40 object-contain">
            </div>

            <!-- New School Logo Preview -->
            <div class="mt-2" x-show="logoPreview">
                <span class="block h-40"
                    x-bind:style="'background-repeat: no-repeat; background-size: contain; background-image: url(\'' + logoPreview + '\');'">
                </span>
            </div>

            <!-- Dynamic Help Text -->
            <p class="text-sm text-red-500 mt-1"
               x-text="schoolType == '1' ? '* {{ __('dashboard.Upload logo SMA dengan ukuran maks 1 MB.') }}' : '* {{ __('dashboard.Upload logo universitas dengan ukuran maks 1 MB.') }}'">
            </p>

            <!-- Dynamic Button Text -->
            <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.schoolLogo.click()"
                               x-text="schoolType == '1' ? '{{ __('dashboard.Perbarui logo SMA') }}' : '{{ __('dashboard.Perbarui logo universitas') }}'">
            </x-secondary-button>

            <x-input-error for="school_logo" class="mt-2" />
        </div>

        <!-- Nomor Telepon (WA) -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="no_telp" value="{{ __('dashboard.Nomor Telepon (WA)') }}" />
            <x-input id="no_telp" type="text" class="mt-1 block w-full" wire:model.defer="state.no_telp" />
            <x-input-error for="no_telp" class="mt-2" />
        </div>

        <!-- Year In -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="year_in" value="{{ __('dashboard.Tahun Masuk') }}" />
            <x-input id="year_in" type="text" class="mt-1 block w-full" wire:model.defer="state.year_in"
                placeholder="20xx"  maxlength="4"/>
            <x-input-error for="year_in" class="mt-2" />
        </div>

        {{-- Twibbon Upload --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="link_twibbon" value="{{ __('dashboard.Link Postingan Twibbon') }}" />
            <x-input id="link_twibbon" type="text" class="mt-1 block w-full" wire:model.defer="state.link_twibbon"
                placeholder="http://instagram.com"/>
            <x-input-error for="link_twibbon" class="mt-2" />
        </div>

        <!-- Kartu Mahasiswa -->
        <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
            <!-- Kartu mahasiswa File Input -->
            <input type="file" class="hidden" wire:model.defer="state.ktm" x-ref="ktm" x-on:change="
                                    photoName = $refs.ktm.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.ktm.files[0]);
                            " />

            <x-label for="ktm" value="{{ __('dashboard.Kartu Tanda Mahasiswa / Kartu Pelajar') }}" />

            <!-- Current kartu mahasiswa -->
            <div class="mt-2" x-show="! photoPreview">
                <img src="{{ $this->user->student_card_url }}" alt="{{ $this->user->name }}" class="h-40">
            </div>

            <!-- New kartu mahasiswa Preview -->
            <div class="mt-2" x-show="photoPreview">
                <span class="block h-40"
                    x-bind:style="'background-repeat: no-repeat; background-size: contain; background-image: url(\'' + photoPreview + '\');'">
                </span>
            </div>

            <p class="text-sm text-red-500">* {{ __('dashboard.Upload kartu tanda mahasiswa/kartu pelajar dengan ukuran maks 1 MB.') }}</p>

            <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.ktm.click()">
                {{ __('dashboard.Perbarui kartu') }}
            </x-secondary-button>

            <x-input-error for="ktm" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('dashboard.Tersimpan') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('dashboard.Simpan') }}
        </x-button>
    </x-slot>
</x-form-section>