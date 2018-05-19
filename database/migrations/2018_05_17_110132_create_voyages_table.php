<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoyagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voyages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('subtitle');
            $table->text('intro');
            $table->text('description');
            $table->string('main_photo');
            $table->double('price');
            $table->double('discount_price')->nullable();
            $table->boolean('is_discounted')->default(0);
            $table->boolean('is_public')->default(0);
            $table->string('duree_du_vol');
            $table->timestamps();
        });

        Schema::table('voyages', function (Blueprint $table){
            $table->integer('ville_id')->unsigned();
            $table->foreign('ville_id')->references('id')->on('villes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('voyages', function (Blueprint $table){
            $table->dropForeign('voyages_ville_id_foreign');
            $table->dropColumn('ville_id');
        });

        Schema::dropIfExists('voyages');
    }
}
