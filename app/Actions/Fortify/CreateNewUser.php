<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
    ], [
        'name.required' => 'Nama harus diisi.',
        'name.string' => 'Nama harus bertipe string.',
        'name.max' => 'Jumlah karakter nama maksimal 255.',
        'email.required' => 'Email harus diisi.',
        'email.string' => 'Email harus bertipe string.',
        'email.max' => 'Jumlah karakter email maksimal 255.',
        'email.email' => 'Email harus bertipe email.',
        'email.unique' => 'Email sudah dipakai oleh akun lain.',
        'password.min' => 'Jumlah karakter password minimal 8 karakter.',
        'password.required' => 'Password harus diisi.',
        'password.string' => 'Password harus bertipe string.',
        'password.confirmed' => 'Konfirmasi password tidak sesuai.',
    ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
