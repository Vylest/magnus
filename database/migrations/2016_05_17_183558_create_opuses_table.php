<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Magnus\Opus;

class CreateOpusesTable extends Migration
{
    /**
     * Create the opus table and it's pivot table
     * @return void
     */
    public function up()
    {

        Schema::create('opuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image_path', 512);
            $table->string('thumbnail_path', 512);
            $table->string('preview_path', 512);
            $table->string('directory')->nullable();
            $table->string('title', 255);
            $table->text('comment')->nullable();
            $table->string('slug', 255);
            $table->integer('views')->nullable();
            $table->integer('daily_views')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['title', 'views', 'daily_views'], 'opus_index');
        });

        Schema::table('opuses', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('gallery_opus', function (Blueprint $table) {
            $table->integer('opus_id')->unsigned();
            $table->integer('gallery_id')->unsigned();
            $table->foreign('opus_id')->references('id')->on('opuses')->onDelete('cascade');
            $table->foreign('gallery_id')->references('id')->on('galleries')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations and delete all the images
     * @return void
     */
    public function down()
    {
        $this->deleteAllOpus();

        Schema::table('opuses', function (Blueprint $table) {
            $table->dropIndex('opus_index');
        });

        Schema::drop('gallery_opus');
        Schema::drop('opuses');
    }

    protected function deleteAllOpus() {
        $opuses = Opus::all();

        foreach ($opuses as $opus) {
            if($opus->deleteImages()) {
                echo "deleted\n";
            }
        }
    }
}
