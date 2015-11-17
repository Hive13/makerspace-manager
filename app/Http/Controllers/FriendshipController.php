<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\User;
use Illuminate\Auth\Guard;
use Laracasts\Flash\Flash;

class FriendshipController extends Controller
{


    protected $user;

    public function __construct(Guard $guard) {
        $this->user = $guard->user();
    }

    public function postAddFriend($id) {
        $toBeFriendedUser = User::find($id);
        $this->user->befriend($toBeFriendedUser);
        Flash::success('You sent a friend request to '.$toBeFriendedUser->name);
        return redirect(url('user'));
    }

    public function postAcceptFriend($id) {
        $newFriendUser = User::find($id);
        $this->user->acceptFriendRequest($newFriendUser);
        Flash::success('You have accepted the friend request from '.$newFriendUser->name);
        return redirect('/');
    }

    public function postDeclineFriend($id) {
        $declinedFriend = User::find($id);
        $this->user->denyFriendRequest($declinedFriend);
        Flash::error('You have declined the friend request for ' . $declinedFriend->name);
        return redirect('/');
    }

    public function postDeleteFriend($id) {
        $newUnFriendUser = User::find($id);
        $this->user->unfriend($newUnFriendUser);
        Flash::warning('You unfriended '.$newUnFriendUser->name);
        return redirect('/');
    }



}
