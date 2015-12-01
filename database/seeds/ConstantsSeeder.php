<?php

    use App\Models\Role;
    use App\Models\User;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Seeder;

    class ConstantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Model::unguard();

        $adminRole = Role::create([
            'name' => 'admin'
        ]);

        $tyler = User::create([
            'name' => 'Tyler Getsay',
            'email' => 't@y.com',
            'password' => bcrypt('password'),
            'key_id' => '1',
            'picture_id' => '1', 'balance' => 100,

        ]);

        $tyler->roles()->attach($adminRole);

        \App\Models\TransactionType::create([
            'name' => 'stripe_deposit',
            'description' => 'Deposit from Stripe', 'cost' => 0, 'locked' => true,
        ]);

        \App\Models\TransactionType::create([
            'name' => 'user_gift',
            'description' => 'Gift from/to another user.', 'cost' => 0, 'locked' => true,
        ]);

        \App\Models\TransactionType::create([
            'name' => 'member_fee',
            'description' => 'Membership Fee', 'cost' => 50,

        ]);


        //Myspace Tom Feature
        User::created(function($user) use ($tyler) {
            //$user->befriend($tyler);
        });
    }
}
