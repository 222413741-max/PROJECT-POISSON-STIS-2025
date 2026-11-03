<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendampingOsc extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pendamping_osc';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'team_id',
        'nama_pendamping',
        'status_pendamping',
        'kontak_wa_pendamping',
        'foto_pendamping',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the team that owns the pendamping.
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Get the full URL for the foto pendamping.
     *
     * @return string|null
     */
    public function getFotoUrlAttribute()
    {
        if (!$this->foto_pendamping) {
            return null;
        }

        return asset('storage/' . $this->foto_pendamping);
    }

    /**
     * Check if pendamping has foto.
     *
     * @return bool
     */
    public function hasFoto()
    {
        return !is_null($this->foto_pendamping);
    }
}
