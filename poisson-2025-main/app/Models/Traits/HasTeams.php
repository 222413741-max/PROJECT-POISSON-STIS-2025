<?php

namespace App\Models\Traits;

use App\Models\Team;
use Illuminate\Support\Facades\Auth;

trait HasTeams
{
    /**
     * get team olimpiade of the users
     *
     * @return object
     */
    public function teamOlimpiade()
    {
        return $this->belongsToMany(Team::class, 'user_team')->where('type', 'olimpiade')->first();
    }

    /**
     * get team infografis of the users
     *
     * @return object
     */
    public function teamInfografis()
    {
        return $this->belongsToMany(Team::class, 'user_team')->where('type', 'infografis')->first();
    }

    /**
     * get team infografis of the users
     *
     * @return object
     */
     public function teamOSC()
    {
        return $this->belongsToMany(Team::class, 'user_team')->where('type', 'osc')->first();
    }

    /**
     * Get all teams of the user
     *
     * @return \Illuminate\Support\Collection
     */
     public function getAllTeams()
    {
        $teams = collect();

        if ($olimpiadeTeam = $this->teamOlimpiade()) {
            $teams->push($olimpiadeTeam);
        }

        if ($oscTeam = $this->teamOSC()) {
            $teams->push($oscTeam);
        }

        if ($infografisTeam = $this->teamInfografis()) {
            $teams->push($infografisTeam);
        }

        return $teams;
    }

    /**
     * assign user to teams by token
     *
     * @param  mixed $token
     * @return void
     */
    public function assignTeams($token, $type)
    {
        $team = Team::where('token', $token)->where('type', $type)->first();

        if (!$team) return false;

        if ($team->isFull()) return false;

        // check if user already has teams
        if ($team->type == 'olimpiade') {
            if ($this->teamOlimpiade()) return false;
        } else if($team->type == 'osc') {
            if ($this->teamOSC()) return false;
        }else {
            if ($this->teamInfografis()) return false;
        }

        try {
            $team->users()->attach(Auth::id());
            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }
}
