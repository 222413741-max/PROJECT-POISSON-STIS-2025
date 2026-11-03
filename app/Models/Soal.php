<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $table = 'soal';

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
     * @param  mixed $type
     * @return object
     */
    public static function getRandomSoal($type)
    {
        return self::all()->where('type', $type)->random();
    }
}
