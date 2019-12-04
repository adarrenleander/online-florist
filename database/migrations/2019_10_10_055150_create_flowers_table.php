<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Flowers table is created with attributes in accordance to class diagram
        Schema::create('flowers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('price');
            $table->string('description');
            $table->unsignedBigInteger('stock');
            $table->string('image');
            $table->timestamps();

            // define a foreign key that references to the FlowerTypes table
            $table->foreign('type_id')->references('id')->on('Flower_Types')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flowers');
    }
}
