<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\User;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $auth;

    public function __construct(Guard $guard) {
        $this->auth = $guard->user();
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $friendships = $this->auth->getAcceptedFriendships();


        //Sigh... there has to be a better way to do this :(
        $returnArray = [];
        foreach($friendships as $friend) {
            if($friend->sender_id == $this->auth->id) {
                $returnArray[] = $friend->recipient;
            } else {
                $returnArray[] = $friend->sender;
            }
        }

        $users = User::All()->diff($returnArray)->diff([$this->auth]);
        return view('user.index')->withFriends($returnArray)->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {

        if($this->auth->isFriendsWith($user) || $this->auth->id = $user->id) {
            return view('user.show')->withUser($user);
        } else {
            return redirect(url('user'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
