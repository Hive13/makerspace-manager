<?php

use Illuminate\Database\Migrations\Migration;

class CreateDepositTransactionType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $transactionType = new \App\Models\TransactionType();
        $transactionType->name = "deposit";
        $transactionType->description = "You have made a deposit";
        $transactionType->cost = 10000;
        $transactionType->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
