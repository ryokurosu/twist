<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Dmstory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dmstories', function (Blueprint $table) {
            $table->increments('dmstory_id');
            $table->string('name')->default('Default Name');
            $table->Integer('id');
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
       Schema::dropIfExists('dmstories');
   }
}
