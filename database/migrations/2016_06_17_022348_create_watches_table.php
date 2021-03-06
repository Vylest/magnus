<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('watches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('watcher_user_id')->unsigned();
            $table->boolean('watch_opus')->nullable();
            $table->boolean('watch_comments')->nullable();
            $table->boolean('watch_activity')->nullable();
            $table->boolean('add_friend')->nullable();
            $table->timestamps();
        });

        Schema::create('user_watch', function (Blueprint $table) {
            $table->integer('watcher_user_id')->unsigned();
            $table->integer('watched_user_id')->unsigned();
            $table->integer('watch_id')->unsigned();
            $table->foreign('watcher_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('watched_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('watch_id')->references('id')->on('watches')->onDelete('cascade');
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
        Schema::drop('user_watch');
        Schema::drop('watches');
    }
}
