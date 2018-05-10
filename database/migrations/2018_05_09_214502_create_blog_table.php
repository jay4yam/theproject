<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('intro');
            $table->string('slug');
            $table->text('content');
            $table->string('main_image');
            $table->boolean('is_public');
            $table->timestamps();
        });

        Schema::table('blogs', function (Blueprint $table){
           $table->integer('user_id')->unsigned();
           $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogs', function (Blueprint $table){
            $table->dropForeign('blogs_user_id_foreign')->unsigned();
            $table->dropColumn('user_id');
        });

        Schema::dropIfExists('blogs');
    }
}
