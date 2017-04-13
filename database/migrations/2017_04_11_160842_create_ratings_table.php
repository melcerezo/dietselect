<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('chef_id')->unsigned();
            $table->integer('foodie_id')->unsigned();
            $table->string('feedback')->nullable();
            $table->integer('rating')->unsigned()->nullable();
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')
                ->on('orders')
                ->onDelete('cascade');
            $table->boolean('is_rated')->default(0);
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
        Schema::dropIfExists('ratings');
    }
}
