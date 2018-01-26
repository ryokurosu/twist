<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Statistics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('statistics', function (Blueprint $table) {
        $table->increments('st_id');
        $table->Integer('account_id');
        $table->Integer('follow')->default(0);
        $table->Integer('follower')->default(0);
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
         Schema::dropIfExists('statistics');
    }
}
