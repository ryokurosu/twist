<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Storytexts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storytexts', function (Blueprint $table) {
            $table->increments('text_id');
            $table->Integer('story_id');
            $table->longtext('text')->nullable();
            $table->string('file')->default('');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        Schema::create('botsettings', function (Blueprint $table) {
            $table->increments('setting_id');
            $table->Integer('account_id');
            $table->Integer('botrule_id')->default(0);
            $table->Integer('botstory_id')->default(0);
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
       Schema::dropIfExists('storytexts');
       Schema::dropIfExists('botsettings');
   }
}
