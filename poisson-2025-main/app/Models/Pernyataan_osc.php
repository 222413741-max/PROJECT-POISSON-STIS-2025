<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pernyataan_osc extends Model
{
    use HasFactory;

    protected $table = 'pernyataan_osc';

    protected $fillable = [
        'team_id',
        'path'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'pernyataan_url'
    ];

    /**
     * getPernyataanUrlAttribute
     *
     * pernyataan_url
     *
     * @return void
     */
    public function getPernyataanUrlAttribute()
    {
        return asset('storage/' . $this->path);
    }

    /**
     * Returns the team associated with the current pernyataan osc.
     *
     * @return \App\Models\Team
     */
    public function team()
    {
        // $team = Team::findOrFail($team_id);
        return $this->belongsTo(Team::class, 'team_id');
    }
}
