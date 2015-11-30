<?php

	use App\Models\User;
	use Illuminate\Foundation\Testing\DatabaseTransactions;

	class UserTest extends TestCase {

		use DatabaseTransactions;

		/**
		 * A basic test example.
		 *
		 * @return void
		 */
		public function testExample() {

			$this->assertTrue(true);
		}

		/*
		 * Make sure we can register a user
		 */
		public function testRegisterUser() {

			$user = factory('App\Models\User')->make();

			$this->visit('/auth/register')->type($user->name, 'name')->type($user->email, 'email')->type('password', 'password')->type('password', 'password_confirmation')->press('Register')->see('Welcome Back, ' . $user->name);
		}

		public function testLogoutUser() {

			$user = factory('App\Models\User')->create();

			$this->actingAs($user)->visit('/auth/logout')->visit('/auth/login')->see(env('SPACE_NAME') . ' Login')->dontSee('Welcome Back');
		}

		public function testLoginUser() {

			$user = factory('App\Models\User')->create();

			$this->visit('/auth/login')->type($user->email, 'email')->type('password', 'password')->press('Login')->see('Welcome Back');
		}

		public function testLoginWrongPassword() {

			$user = factory('App\Models\User')->create();

			$this->visit('/auth/login')->type($user->email, 'email')->type('not_password', 'password')->press('Login')->see('These credentials do not match our records.');
		}

		public function testUserBalance() {

			$user = factory('App\Models\User')->create();

			$trans = factory('App\Models\Transaction')->make(['user_id' => $user->id, 'amount' => -100])->save();

			$user = User::find($user->id);

			$this->assertEquals(400, $user->balance);

		}

		public function testUserRunningBalance() {

			$user = factory('App\Models\User')->create();

			$trans = factory('App\Models\Transaction')->make(['user_id' => $user->id, 'amount' => '-100']);

			$trans->save();

			$this->assertEquals(400, $trans->running);

		}

	}
