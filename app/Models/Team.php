<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Notifications\ReceivedTeamInvitation;
use App\Traits\Teams\TeamTrait;

class Team extends Model
{
	use TeamTrait;
    
    // A team can have many members.
	public function members()
	{
        return $this->belongsToMany('App\Models\User', 'team_user')->withPivot(['is_admin']);
	}

	// A team can be signed-up for many tournaments.
	public function tournaments()
	{
		return $this->belongsToMany('App\Models\Tournament', 'team_tournament')->withPivot(['checked_in', 'disqualified']);
	}

}
