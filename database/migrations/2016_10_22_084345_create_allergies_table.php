<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllergiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allergies', function (Blueprint $table) {
            $table->increments('allergies_id');
            $table->integer('foodies_id')->unsigned();
            $table->integer('ingredients_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('allergies', function ($table){
            $table->foreign('foodies_id')->references('foodies_id')->on('foodies');
            $table->foreign('ingredients_id')->references('id')->on('ingredients');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('allergies');
    }
}
