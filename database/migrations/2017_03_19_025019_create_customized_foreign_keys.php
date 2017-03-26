<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomizedForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customized_ingredient_meals', function ($table){
            $table->foreign('meal_id')->references('id')->on('customized_meals');
//            $table->foreign('ingredient_id')->references('NDB_No')->on('ingredients');
        });
        Schema::table('customized_meals', function ($table){
            $table->foreign('foodie_id')->references('id')->on('foodies');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
