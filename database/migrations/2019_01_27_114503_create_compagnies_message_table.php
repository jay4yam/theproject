<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompagniesMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compagnies_message', function (Blueprint $table) {
            $table->increments('id');
            $table->text('email');
            $table->ipAddress('visitor_ip');
            $table->text('message');
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
        Schema::table('compagnies_message', function (Blueprint $table) {
            $table->dropForeign('compagnies_message_compagnie_id');
            $table->dropColumn('compagnie_id');
        });
        Schema::dropIfExists('compagnies_message');
    }
}
