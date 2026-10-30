<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class soal_semifinal_osc extends Model
{
    use HasFactory;
 
    protected $table = 'soal_semifinal_osc';

    protected $fillable = [
        'name',
        'path',
        'code',
        'type',
        'password'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'soal_url',
    ];

    /** 
     * getSoalUrlAttribute
     *
     * soal_url
     *
     * @return void
     */
    public function getSoalUrlAttribute()
    {
        return asset('storage/' . $this->path);
    }


    /**
     * getRandomSoal
     *
     * @return object
     */
    public static function getRandomSoal()
    {
        return self::all()->random();
    }
}
