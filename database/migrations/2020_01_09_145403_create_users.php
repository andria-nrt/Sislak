<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->string('designation',100)->nullable($value = true);
            $table->string('mobile',50);
            $table->text('address')->nullable($value = true);
            $table->string('email',99);
            $table->string('username',33);
            $table->string('password',66);
            $table->string('remember_token',100)->nullable($value = true);
            $table->tinyInteger('user_role')->comment('1=Admin');
            $table->integer('create_per')->nullable($value = true);
            $table->integer('edit_per')->nullable($value = true);
            $table->integer('delete_per')->nullable($value = true);
            $table->integer('report_per')->nullable($value = true);
            $table->integer('admin');
            $table->integer('accounts');
            $table->string('status',256);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
