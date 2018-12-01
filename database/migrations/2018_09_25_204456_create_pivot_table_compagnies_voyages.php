<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotTableCompagniesVoyages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compagnies_voyages', function (Blueprint $table){
            $table->increments('id');

            $table->integer('compagnies_id')->unsigned();
            $table->foreign('compagnies_id')->references('id')->on('compagnies');

            $table->integer('voyages_id')->unsigned();
            $table->foreign('voyages_id')->references('id')->on('voyages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('compagnies_voyages', function (Blueprint $table){
            $table->dropForeign('compagnies_voyages_compagnies_id_foreign');
            $table->dropForeign('compagnies_voyages_voyages_id_foreign');

            $table->dropColumn('compagnies_id');
            $table->dropColumn('voyages_id');

        });
        Schema::dropIfExists('compagnies_voyages');
    }
}
