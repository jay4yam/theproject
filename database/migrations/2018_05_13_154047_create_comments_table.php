<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->integer('reply_to')->unsigned()->nullable();
            $table->integer('commentable_id')->unsigned();
            $table->string('commentable_type');
            $table->timestamps();
        });

        Schema::table('comments', function (Blueprint $table){
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table){
            $table->dropForeign('comments_user_id_foreign');
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('comments');
    }
}
