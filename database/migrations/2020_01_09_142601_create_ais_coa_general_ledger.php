<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAisCoaGeneralLedger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ais_coa_general_ledger', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ledger_head', 250);
            $table->string('ledger_code', 100);
            $table->integer('type_id')->comment('Foreign Key: ais_coa_types.id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ais_coa_general_ledger');
    }
}
