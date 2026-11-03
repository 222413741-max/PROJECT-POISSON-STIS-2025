<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban_detail_osc extends Model
{
    use HasFactory;

    protected $table = 'jawaban_detail_osc';

    protected $fillable = [
        'jawaban_osc_id',
        'soal_id',
        'answer',
        'status',
        'point'
    ];

    /**
     * Get the jawabanOsc that owns the Jawaban_detail_osc
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jawabanOsc()
    {
        return $this->belongsTo(\App\Models\Jawaban_osc::class);
    }
}
