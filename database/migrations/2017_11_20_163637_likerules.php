<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Likerules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likerules', function (Blueprint $table) {
         $table->Integer('account_id')->primary();
         $table->string('text')->default('');
         $table->string('allowtime')->default('9,10,11,12,13,14,15,16,17,18,19,20,21');
         $table->timestamps();
     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('likerules');
    }
}
