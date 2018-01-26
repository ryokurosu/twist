<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Dmmoniter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dmmoniters', function (Blueprint $table) {
            $table->Integer('account_id');
            $table->Integer('count')->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        Schema::create('followmoniters', function (Blueprint $table) {
            $table->Integer('account_id');
            $table->Integer('count')->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        Schema::create('unfollowmoniters', function (Blueprint $table) {
            $table->Integer('account_id');
            $table->Integer('count')->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        Schema::create('replymoniters', function (Blueprint $table) {
            $table->Integer('account_id');
            $table->Integer('count')->default(0);
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
        Schema::dropIfExists('dmmoniters');
        Schema::dropIfExists('followmoniters');
        Schema::dropIfExists('replymoniters');
        Schema::dropIfExists('unfollowmoniters');
    }
}
