<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    public function update(User $user, array $input): void
    {
        if (isset($input['school_logo']) && !($input['school_logo'] instanceof \Illuminate\Http\UploadedFile)) {
            unset($input['school_logo']);
        }

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'university_tipe' => ['required'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'link_twibbon' => ['required'],
            'ktm' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ];

        $messages = [
            'name.required' => 'Kolom nama harus diisi.',
            'name.string' => 'Kolom nama harus bertipe string.',
            'name.max' => 'Jumlah karakter kolom nama maksimal 255.',
            'university_tipe.required' => 'Kolom jenis akun harus diisi.',
            'email.required' => 'Kolom email harus diisi.',
            'email.email' => 'Kolom email harus bertype email.',
            'email.max' => 'Jumlah karakter kolom email maksimal 255.',
            'email.unique' => 'Email sudah dipakai oleh user lain',
            'photo.mimes' => 'Foto yang diupload harus bertipe jpg, jpeg, atau png',
            'photo.max' => 'Ukuran foto maksimal 1 MB',
            'link_twibbon.required' => 'Link postingan instagram twibbon harus diisi.',
            'ktm.mimes' => 'KTM yang diupload harus bertipe jpg, jpeg, atau png',
            'ktm.max' => 'Ukuran ktm maksimal 1 MB',
        ];

        // Hanya tambahkan validasi school_logo jika benar-benar ada file baru yang diupload
        if (isset($input['school_logo']) && !empty($input['school_logo'])) {
            $rules['school_logo'] = ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'];
            $messages['school_logo.mimes'] = 'Logo sekolah yang diupload harus bertipe jpg, jpeg, atau png';
            $messages['school_logo.max'] = 'Ukuran logo sekolah maksimal 1 MB';
        }

        Validator::make($input, $rules, $messages)->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if (isset($input['ktm']) && !empty($input['ktm'])) {
            if ($user->student_card) {
                \Storage::disk('public')->delete($user->student_card);
            }

            $path = $input['ktm']->store('student-card', 'public');
            $user->forceFill([
                'student_card' => $path,
            ])->save();
        }

        if (isset($input['school_logo']) && !empty($input['school_logo'])) {
            if ($user->school_logo) {
                \Storage::disk('public')->delete($user->school_logo);
            }

            $path = $input['school_logo']->store('school-logos', 'public');
            $user->forceFill([
                'school_logo' => $path,
            ])->save();
        }

        if (
            $input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'university_tipe' => $input['university_tipe'],
                'college' => $input['college'],
                'no_telp' => $input['no_telp'],
                'year_in' => $input['year_in'],
                'link_twibbon' => $input['link_twibbon'],
            ])->save();
        }
    }

    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'university_tipe' => $input['university_tipe'],
            'college' => $input['college'],
            'no_telp' => $input['no_telp'],
            'year_in' => $input['year_in'],
            'link_twibbon' => $input['link_twibbon'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
