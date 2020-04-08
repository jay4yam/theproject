<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScrapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scrap', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url');
            $table->enum('status', ['wait', 'done', 'failed'])->default('wait');
            $table->integer('voyage_id')->unsigned()->nullable();
            $table->foreign('voyage_id')->references('id')->on('voyages');
            $table->integer('compagnie_id')->unsigned();
            $table->foreign('compagnie_id')->references('id')->on('compagnies');
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
        Schema::table('scrap', function (Blueprint $table) {
            $table->dropForeign('scrap_voyage_id_foreign');
            $table->dropColumn('voyage_id');
            $table->dropForeign('scrap_compagnie_id_foreign');
            $table->dropColumn('compagnie_id');
        });

        Schema::dropIfExists('scrap');
    }
}
