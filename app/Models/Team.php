<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Pernyataan_osc;

class Team extends Model
{
    use HasFactory;
    use HasRoles;

    protected $table = 'teams';

    protected $fillable = [
        'name',
        'type',
        'token',
    ];

    protected $attributes = [
        'confirmed' => false,
    ];

    protected $guard_name = 'teams';

    /**
     * users
     *
     * @return object
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_team');
    }

    /**
     * payments
     *
     * @return object
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * olimpiade relationship
     *
     * @return void
     */
    public function olimpiade()
    {
        return $this->hasMany(Olimpiade::class);
    }

    /**
     * pernyataanOsc relationship
     *
     * @return eloquent collection
     */
    public function pernyataanOsc()
    {
        return $this->hasOne(\App\Models\Pernyataan_osc::class);
    }

    /**
     * pendampingOsc relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pendampingOsc()
    {
        return $this->hasOne(\App\Models\PendampingOsc::class);
    }

    /**
     * semifinalOsc relationship
     *
     * @return void
     */
    public function semifinalOsc()
    {
        return $this->hasMany(\App\Models\Jawaban_semifinal_osc::class);
    }

    /**
     * infografis relationship
     *
     * @return void
     */
    public function infografis()
    {
        return $this->hasOne(Infografis::class);
    }

    /**
     * isFull
     *
     * cek apakah timnya sudah full atau belum.
     * ketentuan 1 tim 2 orang
     *
     * @return boolean
     */
    public function isFull()
    {
        $type = $this->type;
        $count = $this->users()->count();
        switch ($type) {
            case 'olimpiade':
                return $count >= 2 ? true : false;
                break;

            case 'osc':
                return $count >= 3 ? true : false;
                break;

            case 'infografis':
                return $count >= 1 ? true : false;
                break;

            default:
                return false;
                break;
        }
    }

    /**
     * createOlimpiade
     *
     * @param  string $name
     * @return object
     */
    public static function createOlimpiade($name)
    {
        return self::create([
            'name' => $name,
            'type' => 'olimpiade',
            'token' => Str::random(6)
        ]);
    }

    /**
     * createInfografis
     *
     * @param  string $name
     * @return object
     */
    public static function createInfografis($name)
    {
        return self::create([
            'name' => $name,
            'type' => 'infografis',
            'token' => Str::random(6)
        ]);
    }

    /**
     * createInfografis
     *
     * @param  string $name
     * @return object
     */
     public static function createOSC($name)
    {
        return self::create([
            'name' => $name,
            'type' => 'osc',
            'token' => Str::random(6)
        ]);
    }

    private static function getTeams($name)
    {
        return self::where('type', $name);
    }

    /**
     * getOlimpiade
     *
     * @return object
     */
    public static function getOlimpiade()
    {
        return self::getTeams('olimpiade');
    }

    /**
     * getInfografis
     *
     * @return object
     */
    public static function getInfografis()
    {
        return self::getTeams('infografis');
    }

    /**
     * getOSC
     *
     * @return object
     */
     public static function getOSC() 
    {
        return self::getTeams('osc');
    }

    /**
     * getPernyataanOsc
     *
     * @param  mixed $team_id
     * @return object
     */
    public function getPernyataanOsc()
    {
        return Pernyataan_osc::where('team_id', $this->id)->first();
    }

    /**
     * getPendampingOsc
     *
     * @return PendampingOsc|null
     */
    public function getPendampingOsc()
    {
        return PendampingOsc::where('team_id', $this->id)->first();
    }

    public function getUserOrderInTeam(User $user = null)
    {
        if (!$user) {
            $user = auth()->user();
        }

        $members = $this->users()->orderBy('created_at')->get();

        $order = $members->search(function ($member) use ($user) {
            return $member->id === $user->id;
        });

        $order += 1;

        return $order;
    }
}
