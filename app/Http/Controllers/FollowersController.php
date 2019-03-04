<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class FollowersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function store(User $user)
    {
        $this->authorize('follow', $user);

        if ( ! Auth::user()->isFollowing($user->id)) {
            Auth::user()->follow(['id' => $user->id]);
        }

        return redirect()->route('users.show', $user->id);
    }

    public function destroy(User $user)
    {
        $this->authorize('follow', $user);
        if (Auth::user()->isFollowing($user->id)) {
            Auth::user()->unfollow(['id' => $user->id]);
        }

        return redirect()->route('users.show', $user->id);
    }
}
