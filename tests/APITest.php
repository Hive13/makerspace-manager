<?php

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class APITest extends TestCase
{

		use DatabaseTransactions;

		protected $endPoint = '/api/v1/';

		public function testPing() {

			$response = $this->call('GET', $this->endPoint . 'ping');
			$this->assertEquals('pong', $response->content());
		}

		public function testAcceptedPermission() {

			$user = factory('App\Models\User')->create();

			$permission = factory('App\Models\Permission')->create();

			$user->permissions()->save($permission);

			$response = $this->call('GET', $this->endPoint . 'perm/' . $user->key_id . '/' . $permission->name);

			$this->assertEquals(200, $response->status());

		}

		public function testDeniedPermission() {

			$user = factory('App\Models\User')->create();

			$permission = factory('App\Models\Permission')->create();

			$response = $this->call('GET', $this->endPoint . 'perm/' . $user->key_id . '/' . $permission->name);

			$this->assertNotEquals(200, $response->status());
		}

		public function testNonexistantPermission() {

			$user = factory('App\Models\User')->create();

			$permission = factory('App\Models\Permission')->make();

			$response = $this->call('GET', $this->endPoint . 'perm/' . $user->key_id . '/' . $permission->name);

			$this->assertNotEquals(200, $response->status());
		}

		public function testAcceptedTransaction() {

			$user = factory('App\Models\User')->create();

			$transtype = factory('App\Models\TransactionType')->create(['permission_id' => 'none']);

			$response = $this->call('GET', $this->endPoint . 'trans/' . $user->key_id . '/' . $transtype->name);

			$this->assertEquals(200, $response->status());
		}

		public function testAcceptedTransactionBalance() {

			$user = factory('App\Models\User')->create();

			$transtype = factory('App\Models\TransactionType')->create(['permission_id' => 'none']);

			$response = $this->call('GET', $this->endPoint . 'trans/' . $user->key_id . '/' . $transtype->name);

			$user = User::find($user->id);

			$this->assertNotEquals(500, $user->balance);
		}

		public function testDeniedTransactionBecauseOfBalance() {

			$user = factory('App\Models\User')->create(['balance' => '1']);

			$transtype = factory('App\Models\TransactionType')->create(['cost' => '100']);

			$response = $this->call('GET', $this->endPoint . 'trans/' . $user->key_id . '/' . $transtype->name);

			$this->assertNotEquals(200, $response->status());
		}

		public function testDeniedTransactionBalance() {

			$user = factory('App\Models\User')->create(['balance' => '1']);

			$transtype = factory('App\Models\TransactionType')->create(['cost' => '100']);

			$response = $this->call('GET', $this->endPoint . 'trans/' . $user->key_id . '/' . $transtype->name);

			$user = User::find($user->id);

			$this->assertEquals(1, $user->balance);
		}
	}
