<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeyConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('allergies', function ($table){
            $table->foreign('foodies_id')->references('foodies_id')->on('foodies');
            $table->foreign('ingredients_id')->references('ingredients_id')->on('ingredients');
        });

        Schema::table('plans', function ($table){
            $table->foreign('meals_id')->references('meals_id')->on('meals');
        });

        Schema::table('meals', function ($table){
            $table->foreign('chefs_plans_id')->references('chefs_plans_id')->on('chefs_plans');
        });

        Schema::table('chefs_plans', function ($table){
            $table->foreign('plans_id')->references('plans_id')->on('plans');
        });

        Schema::table('orders', function ($table){
            $table->foreign('plans_id')->references('plans_id')->on('plans');
            $table->foreign('foodies_id')->references('foodies_id')->on('foodies');
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
