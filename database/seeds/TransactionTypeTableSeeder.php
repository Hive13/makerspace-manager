<?php

use Illuminate\Database\Seeder;

class TransactionTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Models\TransactionType')->times(4)->create();
    }
}
