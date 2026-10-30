<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Olimpiade extends Model
{
    use HasFactory;

    protected $table = 'olimpiade';

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
        return $this->belongsTo(Soal::class);
    }

}
