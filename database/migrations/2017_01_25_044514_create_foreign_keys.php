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
        Schema::table('messages', function ($table){
            $table->foreign('foodie_id')->references('id')->on('foodies')
                ->onDelete('cascade');
            $table->foreign('chef_id')->references('id')->on('chefs')
                ->onDelete('cascade');;
        });

        Schema::table('foodie_address', function ($table){
            $table->foreign('foodie_id')->references('id')->on('foodies')
            ->onDelete('cascade');
        });

        Schema::table('allergies', function ($table){
            $table->foreign('foodie_id')->references('id')->on('foodies')
            ->onDelete('cascade');
//            $table->foreign('ingredient_id')->references('id')->on('ingredients');
        });

        Schema::table('foodie_preferences', function ($table){
            $table->foreign('foodie_id')->references('id')->on('foodies')
            ->onDelete('cascade');
        });

        Schema::table('meals', function ($table){
            $table->foreign('chef_id')->references('id')->on('chefs')
            ->onDelete('cascade');
        });

        Schema::table('ingredient_meal', function ($table){
            $table->foreign('meal_id')->references('id')->on('meals');
//            $table->foreign('ingredient_id')->references('NDB_No')->on('ingredients');
        });

        Schema::table('plans', function ($table){
            $table->foreign('chef_id')->references('id')->on('chefs')
            ->onDelete('cascade');
        });

        Schema::table('meal_plans', function ($table){
            $table->foreign('plan_id')->references('id')->on('plans')
            ->onDelete('cascade');
            $table->foreign('meal_id')->references('id')->on('meals')
            ->onDelete('cascade');
        });

        Schema::table('orders', function ($table){
            $table->foreign('chef_id')->references('id')->on('chefs')
            ->onDelete('cascade');
            $table->foreign('foodie_id')->references('id')->on('foodies')
            ->onDelete('cascade');
            $table->foreign('plan_id')->references('id')->on('plans')
            ->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('messages', function (Blueprint $table){
            $table->dropForeign('message_chef_id_foreign');
            $table->dropForeign('message_foodie_id_foreign');
        });

        Schema::table('foodie_address', function (Blueprint $table){
            $table->dropForeign('foodie_address_foodie_id_foreign');
        });

        Schema::table('allergies', function (Blueprint $table){
            $table->dropForeign('allergies_foodie_id_foreign');
        });

        Schema::table('foodie_preferences', function (Blueprint $table){
            $table->dropForeign('foodie_preferences_foodie_id_foreign');
        });

        Schema::table('meals', function (Blueprint $table){
            $table->dropForeign('meals_chef_id_foreign');
        });

//        Schema::table('ingredient_meal', function (Blueprint $table){
//            $table->dropForeign('ingredient_meal_meal_id_foreign');
////            $table->dropForeign('ingredient_meal_ingredient_id_foreign');
//        });

        Schema::table('plans', function (Blueprint $table){
            $table->dropForeign('plans_chef_id_foreign');
        });

        Schema::table('meal_plans', function (Blueprint $table){
            $table->dropForeign('meal_plans_plan_id_foreign');
            $table->dropForeign('meal_plans_meal_id_foreign');
        });

        Schema::table('orders', function (Blueprint $table){
            $table->dropForeign('orders_chef_id_foreign');
            $table->dropForeign('orders_foodie_id_foreign');
            $table->dropForeign('orders_plan_id_foreign');
        });
    }
}
