<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('orders_id');
            $table->integer('foodies_id')->unsigned();
            $table->integer('plans_id')->unsigned();
            $table->string('order_is_paid');
            $table->timestamps();
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
        Schema::drop('orders');
    }
}
