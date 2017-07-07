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
            $table->increments('id');
            $table->integer('foodie_id')->unsigned();
            $table->integer('address_id')->unsigned();
            $table->tinyInteger('is_paid')->default(0);
            $table->timestamps();
        });

//        $table->integer('chef_id')->unsigned();
//        $table->integer('plan_id')->unsigned();
//        $table->string('order_type')->default('s');
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
