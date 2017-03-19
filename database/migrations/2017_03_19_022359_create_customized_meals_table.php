<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomizedMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customized_meals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('foodie_id')->unsigned();
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
        Schema::dropIfExists('customized_meals');
    }
}
