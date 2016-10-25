<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('plans_id');
            $table->string('daycode');
            $table->string('mealtype');
            $table->integer('meals_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('plans', function ($table){
            $table->foreign('meals_id')->references('meals_id')->on('meals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('plans');
    }
}
