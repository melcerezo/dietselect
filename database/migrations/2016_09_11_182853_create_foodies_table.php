<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foodies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('last_name', 100);
            $table->string('first_name', 100);
            $table->char('gender', 1)->nullable(); //Values: M, F, N
            $table->date('birthday')->nullable();
            $table->string('email')->unique();
            $table->string('mobile_number', 12)->unique();
            $table->string('username', 20)->unique()->nullable()->default(null);
            $table->boolean('joined_newsletter');
            $table->string('password');
            $table->rememberToken();
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
        Schema::drop('foodies');
    }
}
