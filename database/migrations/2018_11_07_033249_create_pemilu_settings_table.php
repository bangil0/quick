<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemiluSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemilu_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pemilu_name');
            $table->integer('type_candidates_id');
            $table->integer('province_id')->nullable();
            $table->integer('kokab_id')->nullable();
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
        Schema::dropIfExists('pemilu_settings');
    }
}
