<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAisAccountsConfig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ais_accounts_config', function (Blueprint $table) {
            $table->increments('id');
            $table->string('particular', 30);
            $table->string('particular_name', 100);
            $table->tinyInteger('coa_level')->comment('2=GL, 3=SL');
            $table->string('account_code', 20);
            $table->integer('type_id')->comment('Foreign Key: ais_coa_types.id');
            $table->integer('gl_id')->comment('Foreign Key: ais_coa_general_ledger.id');
            $table->integer('sl_id')->comment('Foreign Key: ais_coa_subsidiary_ledger.id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ais_accounts_config');
    }
}
