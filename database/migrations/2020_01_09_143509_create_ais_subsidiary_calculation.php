<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAisSubsidiaryCalculation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ais_subsidiary_calculation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('particular_sl')->comment('Foreign Key: ais_coa_subsidiary_ledger.id');
            $table->integer('gl_ledger')->comment('Foreign Key: ais_coa_general_ledger.id');
            $table->integer('sub_ledger')->comment('Foreign Key: ais_coa_subsidiary_ledger.id');
            $table->integer('acc_type')->comment('Foreign Key: ais_coa_types.id');
            $table->date('transaction_date');
            $table->float('debit_amount', 11, 2);
            $table->float('credit_amount', 11, 2);
            $table->integer('voucher_id')->comment('Foreign Key: ais_vouchers.id');
            $table->integer('voucher_details_id')->comment('Foreign Key: ais_voucher_details.id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ais_subsidiary_calculation');
    }
}
