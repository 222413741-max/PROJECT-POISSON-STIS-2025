<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban_semifinal_osc extends Model
{
    use HasFactory;

    protected $table = 'jawaban_semifinal_osc';

    protected $fillable = [
        'team_id',
        'soal_id',
        'tahap',
        'url',
        'uploaded_at'
    ];

    protected $dates = ['uploaded_at'];

    /**
     * soal
     *
     * @return void
     */
    public function soal()
    {
        return $this->belongsTo(\App\Models\Soal_semifinal_osc::class);
    }

}
