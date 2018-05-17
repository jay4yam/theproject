<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVillesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('villes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullabel();
            $table->timestamps();
        });

        Schema::table('villes', function (Blueprint $table){
            $table->integer('region_id')->unsigned();
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('villes', function (Blueprint $table){
            $table->dropForeign('villes_region_id_foreign');
            $table->dropColumn('region_id');
        });

        Schema::dropIfExists('villes');
    }
}
