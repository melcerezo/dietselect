<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->increments('meals_id');
            $table->string('mealdescription');
            $table->integer('chefs_plans_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('meals', function ($table){
            $table->foreign('chefs_plans_id')->references('chefs_plans_id')->on('chefs_plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('meals');
    }
}
