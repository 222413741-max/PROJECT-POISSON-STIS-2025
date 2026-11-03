<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal_osc extends Model
{
    use HasFactory;

    protected $table = 'soal_osc';

    protected $fillable = [
        'question',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'option_e',
        'option_key',
        'type',
        'correct_point',
        'wrong_point',
        'blank_point',
        'package',
    ];
}
