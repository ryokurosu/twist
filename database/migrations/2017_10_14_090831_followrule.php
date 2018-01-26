<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Followrule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     Schema::create('followrules', function (Blueprint $table) {
        $table->increments('followrule_id');
        $table->Integer('account_id');
        $table->Integer('span')->default(10);
        $table->Integer('limit')->default(0);
        $table->string('allowtime')->default('9,10,11,12,13,14,15,16,17,18,19,20,21');
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
    });

     Schema::create('unfollowrules', function (Blueprint $table) {
        $table->increments('unfollowrule_id');
        $table->Integer('account_id');
        $table->Integer('span')->default(10);
        $table->Integer('limit')->default(0);
        $table->string('allowtime')->default('9,10,11,12,13,14,15,16,17,18,19,20,21');
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
       Schema::dropIfExists('followrules');
       Schema::dropIfExists('unfollowrules');
   }
}
