<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompagniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compagnies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('raison_sociale');
            $table->string('adresse');
            $table->string('code_postal');
            $table->string('ville');
            $table->string('telephone');
            $table->string('email');
            $table->string('mail_resa');
            $table->string('num_licence');
            $table->text('baseline');
            $table->text('intro');
            $table->text('presentation');
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
        Schema::dropIfExists('compagnies');
    }
}
