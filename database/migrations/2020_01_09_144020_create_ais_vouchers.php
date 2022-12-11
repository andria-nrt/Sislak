<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAisVouchers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ais_vouchers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_code',50);
            $table->integer('voucher_code_number');
            $table->tinyInteger('transaction_type')->comment('1=Payment, 2=Receive, 3=Journal, 4=Contra');
            $table->float('transaction_amount', 11, 2);
            $table->date('transaction_date');
            $table->text('remarks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ais_vouchers');
    }
}
