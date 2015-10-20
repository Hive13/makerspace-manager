<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        App\Models\User::Create([
            'name' => 'Tyler Getsay',
            'email' => 'tylergetsay@gmail.com',
            'password' => bcrypt(env('SPACE_NAME')),
            'balance' => '20',
            'key_id' => '1',
            'picture_id' => 'tylergets'
        ]);

        factory('App\Models\User')->times(20)->create();
    }
}
