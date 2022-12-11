<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAisVoucherDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ais_voucher_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('voucher_id')->comment('Foreign Key: ais_vouchers.id');
            $table->integer('dr_gl_ledger');
            $table->integer('dr_sub_ledger');
            $table->integer('cr_gl_ledger');
            $table->integer('cr_sub_ledger');
            $table->float('transaction_amount', 11, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ais_voucher_details');
    }
}
