<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->index();
            $table->integer('follows_id')->index();
            $table->timestamps();
            // $table->foreign('follower_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->nullableTimestamps();
    });
    //     Schema::create('followers', function (Blueprint $table) {
    //     $table->increments('id');
    //     $table->integer('user_id')->index();
    //     $table->integer('follows_id')->index();
    //     $table->boolean('following');
    //     $table->timestamps();
    // });
}




    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('followers');
    }
}
