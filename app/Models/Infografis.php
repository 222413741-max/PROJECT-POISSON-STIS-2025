<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infografis extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'name',
        'description',
        'infografis',
        'orisinalitas',
        'ppt',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
