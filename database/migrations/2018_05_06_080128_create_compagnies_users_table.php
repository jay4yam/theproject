<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompagniesUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compagnies_users', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('compagny_id')->unsigned();
            $table->foreign('compagny_id')->references('id')->on('compagnies');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::table('compagnies_users', function (Blueprint $table){
            $table->dropForeign('compagnies_users_compagny_id_foreign');
            $table->dropForeign('compagnies_users_user_id_foreign');

            $table->dropColumn('compagny_id');
            $table->dropColumn('user_id');

        });
        Schema::dropIfExists('compagnies_users');
    }
}
