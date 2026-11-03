<?php

namespace App\Models;

use App\Models\Traits\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
#class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use HasTeams;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'university_tipe',
        'college',
        'no_telp',
        'password',
        'link_twibbon',
        'student_card',
        'school_logo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'student_card_url',
        'school_logo_url',
    ];


    /**
     * getStudentCardUrlAttribute
     *
     * get student card, return default image when null.
     * access it with student_card_url
     *
     * @return void
     */
    public function getStudentCardUrlAttribute()
    {
        return $this->attributes['student_card']
            ? asset('storage/' . $this->student_card)
            : "https://dummyimage.com/600x400&text=kartu+mahasiswa";
    }

    /**
     * Get the URL to the user's school logo.
     * access it with school_logo_url
     */
    public function getSchoolLogoUrlAttribute(): string
    {
        return isset($this->attributes['school_logo']) && $this->school_logo
            ? asset('storage/' . $this->school_logo)
            : "https://dummyimage.com/400x400&text=logo+institusi";
    }

    /**
     * Delete the user's school logo.
     */
    public function deleteSchoolLogo(): void
    {
        if ($this->school_logo && \Storage::disk('public')->exists($this->school_logo)) {
            \Storage::disk('public')->delete($this->school_logo);
        }

        $this->forceFill([
            'school_logo' => null,
        ])->save();
    }

    /**
     * Get the jawabanOsc associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function jawabanOsc()
    {
        return $this->hasOne(\App\Models\Jawaban_osc::class, 'user_id', 'id');
    }
}
