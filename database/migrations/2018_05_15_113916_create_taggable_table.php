<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaggableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taggables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('taggable_id');
            $table->string('taggable_type');
            $table->timestamps();
        });

        Schema::table('taggables', function (Blueprint $table){
            $table->integer('tag_id')->unsigned();
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('taggables', function (Blueprint $table){
            $table->dropForeign('taggables_tag_id_foreign')->unsigned();
            $table->dropColumn('tag_id');
        });

        Schema::dropIfExists('taggables');
    }
}
