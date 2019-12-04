<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Detail_Transaction table is created with attributes in accordance to class diagram
        Schema::create('detail_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('header_transaction_id');
            $table->unsignedBigInteger('flower_id');
            $table->unsignedBigInteger('quantity');
            $table->timestamps();

            // define a foreign key that references to the Header_Transactions table
            $table->foreign('header_transaction_id')->references('id')->on('Header_Transactions')->onDelete('cascade')->onUpdate('cascade');
            // define a foreign key that references to the Flowers table
            $table->foreign('flower_id')->references('id')->on('Flowers')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_transactions');
    }
}
