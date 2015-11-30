<?php

	namespace App\Models;

	class Friendship extends Model {

		protected $fillable = ['sender_id', 'recipient_id', 'accepted'];

		public function sender() {

			return $this->hasOne('App\Models\User', 'id', 'sender_id');
		}

		public function recipient() {

			return $this->hasOne('App\Models\User', 'id', 'recipient_id');
		}
	}
