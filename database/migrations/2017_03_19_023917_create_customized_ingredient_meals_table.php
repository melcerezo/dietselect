<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomizedIngredientMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customized_ingredient_meals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('meal_id')->unsigned();
            $table->string('ingredient_id');
            $table->double('grams');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customized_ingredient_meals');
    }
}
