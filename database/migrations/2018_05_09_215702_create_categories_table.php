<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->timestamps();
        });

        Schema::create('blogs_categories', function (Blueprint $table){
            $table->increments('id');

            $table->integer('blog_id')->unsigned();
            $table->foreign('blog_id')->references('id')->on('blogs');

            $table->integer('categorie_id')->unsigned();
            $table->foreign('categorie_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogs_categories', function (Blueprint $table){
            $table->dropForeign('blogs_categories_categorie_id_foreign');
            $table->dropForeign('blogs_categories_blog_id_foreign');
        });
        Schema::dropIfExists('blogs_categories');

        Schema::dropIfExists('categories');
    }
}
