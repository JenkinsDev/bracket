<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\TeamInvite;
use App\Models\User;
use Illuminate\Http\Request;

class TeamInvitesController extends Controller
{

	// Accepts invition for a team..
	public function accept($token) {
		$invite = TeamInvite::getFromToken($token);
		if (!$invite) {
			abort(404);
		}

		if (auth()->check()) {
			User::acceptInvite($invite);
			return redirect('/teams');
		} else {
			session(['invite_token' => $token]);
			return redirect()->to('login');
		}
	}

}
