<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban_osc extends Model
{
    use HasFactory;

    protected $table = 'jawaban_osc';

    protected $fillable = [
        'user_id',
        'package',
        'status',
        'total_points',
        'time_over'
    ];

    /**
     * Get all of the jawabanDetail for the Jawaban_osc
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jawabanDetail()
    {
        return $this->hasMany(\App\Models\Jawaban_detail_osc::class, 'jawaban_osc_id', 'id');
    }

    /**
     * Get the user associated with the Jawaban_osc
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'user_id');
    }
}
