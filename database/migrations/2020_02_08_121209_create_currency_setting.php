<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrencySetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_setting', function (Blueprint $table) {
            $table->increments('id');
            $table->string('currency',256);
            $table->string('symbol',256);
            $table->string('currency_text',256);
            $table->string('currency_position',256);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currency_setting');
    }
}
