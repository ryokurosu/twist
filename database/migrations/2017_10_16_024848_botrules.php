<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Botrules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('botrules', function (Blueprint $table) {
        $table->increments('botrule_id');
        $table->Integer('id');
         $table->string('name')->default('Default Name');
        $table->Integer('span')->default(30);
        $table->Integer('limit')->default(48);
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
        Schema::dropIfExists('botrules');
    }
}
