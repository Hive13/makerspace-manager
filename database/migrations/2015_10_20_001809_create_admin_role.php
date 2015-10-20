<?php

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;

class CreateAdminRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $adminRole = new Role();
        $adminRole->name = "admin";
        $adminRole->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
