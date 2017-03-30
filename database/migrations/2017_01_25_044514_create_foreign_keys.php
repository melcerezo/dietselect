<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('foodie_address', function ($table){
            $table->foreign('foodie_id')->references('id')->on('foodies');
        });

        Schema::table('allergies', function ($table){
            $table->foreign('foodie_id')->references('id')->on('foodies');
//            $table->foreign('ingredient_id')->references('id')->on('ingredients');
        });

        Schema::table('foodie_preferences', function ($table){
            $table->foreign('foodie_id')->references('id')->on('foodies');
        });

        Schema::table('meals', function ($table){
            $table->foreign('chef_id')->references('id')->on('chefs');
        });

        Schema::table('ingredient_meal', function ($table){
            $table->foreign('meal_id')->references('id')->on('meals');
            $table->foreign('ingredient_id')->references('NDB_No')->on('ingredients');
        });

        Schema::table('plans', function ($table){
            $table->foreign('chef_id')->references('id')->on('chefs');
        });

        Schema::table('meal_plans', function ($table){
            $table->foreign('plan_id')->references('id')->on('plans');
            $table->foreign('meal_id')->references('id')->on('meals');
        });

        Schema::table('orders', function ($table){
            $table->foreign('chef_id')->references('id')->on('chefs');
            $table->foreign('foodie_id')->references('id')->on('foodies');
            $table->foreign('plan_id')->references('id')->on('plans');
        });

        Schema::table('deposits', function ($table){
           $table->foreign('order_id')->references('id')->on('orders')
               ->onDelete('cascade');
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
