<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction_number');
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('courier_id');
            $table->dateTime('date');
            $table->enum('transaction_status', ['proccess', 'shipped', 'in_shipping', 'arrived'])->default('proccess')->nullable();
            $table->integer('total_amount')->nullable();
            $table->text('note')->nullable();
            $table->string('receipt_number')->nullable();
            $table->timestamps();

            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('member_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('courier_id')->references('id')->on('couriers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
