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
            $table->dateTime('transaction_date');
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('courier_id');
            $table->unsignedBigInteger('flower_id');
            $table->unsignedBigInteger('quantity');
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('Users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('courier_id')->references('id')->on('Couriers')->onDelete('cacade')->onUpdate('cascade');
            $table->foreign('flower_id')->referecnes('id')->on('Flowers')->onDelete('cascade')->onUpdate('cascade');
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
