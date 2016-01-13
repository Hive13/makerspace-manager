<?php

	namespace App\Http\Controllers;

	use App\Http\Requests;
	use App\Models\User;
	use Illuminate\Auth\Guard;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Hash;
	use Laracasts\Flash\Flash;

	class UserController extends Controller {

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
		public function index() {

			$friendships = $this->auth->getAcceptedFriendships();

			$returnArray = [];
			foreach ($friendships as $friendship) {
				if ($friendship->sender_id == $this->auth->id) {
					$returnArray[] = $friendship->recipient_id;
				} else {
					$returnArray[] = $friendship->sender_id;
				}
			}

			$returnArray = User::find($returnArray);

			$users = User::All()->diff($returnArray)->diff([$this->auth]);

			return view('user.index')->withFriends($returnArray)->withUsers($users);
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create() {
			//
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function store(Request $request) {
			//
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function show(User $user) {

			if ($this->auth->id == $user->id) {
				return redirect(url('user/' . $user->id . '/edit'));
			}
			if ($this->auth->isFriendsWith($user)) {
				return view('user.show')->withUser($user);
			} else {
				return redirect(url('user'));
			}

		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function edit(User $user) {

			$this->authorize('edit-profile');

			return view('user.edit')->withUser($user);
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param  int                      $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function update(Requests\UpdateProfileRequest $request, User $user) {

			$this->authorize('edit-profile');

			if ($request->hasFile('file')) {
				$profilePic = $request->file('file');
				$id = md5($profilePic);
				$profilePic->move(public_path('/img/pp/'), $id);
				if (file_exists(public_path('img/pp/' . $user->picture_id))) {
					unlink(public_path('img/pp/' . $user->picture_id));
				}
				$user->picture_id = $id;
			}

			foreach ($request->only(['name', 'email']) as $key => $value) {
				$user->$key = $value;
			}
			$user->save();

			return redirect()->back();
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function destroy($id) {
			//
		}

		public function changePassword(Request $request) {

			$user = $this->auth;

			if (Hash::check($request->input('password'), $user->password)) {

				$user->password = Hash::make($request->input('new_password'));
				$user->save();
				Flash::success('Password changed successfully.');

			} else {

				Flash::error('Invalid password');
			}

			return redirect()->back();

		}
	}
