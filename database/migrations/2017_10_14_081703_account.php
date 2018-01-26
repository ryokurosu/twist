<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Account extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
        $table->increments('account_id');
        $table->Integer('id');
        $table->string('consumerkey');
        $table->string('consumersecret');
        $table->string('accesstoken');
        $table->string('accesstokensecret');
        $table->string('screenname')->unique();
        $table->string('password');
        $table->string('tel');
        $table->string('ip');
        $table->string('status')->default(0);
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
    });
   }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          Schema::dropIfExists('accounts');
    }
}
