<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Dmtexts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dmtexts', function (Blueprint $table) {
        $table->increments('dmtext_id');
        $table->Integer('dmstory_id');
        $table->longtext('text');
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
    });

        Schema::create('dmsettings', function (Blueprint $table) {
        $table->increments('dmsetting_id');
        $table->Integer('account_id');
        $table->Integer('dmrule_id')->default(0);
        $table->Integer('dmstory_id')->default(0);
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
         Schema::dropIfExists('dmtexts');
         Schema::dropIfExists('dmsettings');
    }
}
