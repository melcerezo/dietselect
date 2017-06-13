<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChefCustomMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chef_customized_meals', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('meal_id')->unsigned();
        $table->integer('chef_id')->unsigned();
        $table->integer('plan_id')->unsigned()->default(0);
        $table->integer('mealplan_id')->unsigned()->default(0);
        $table->string('description');
        $table->string('main_ingredient');
        $table->double('calories')->default(0);
        $table->double('carbohydrates')->default(0);
        $table->double('protein')->default(0);
        $table->double('fat')->default(0);
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
        //
    }
}
