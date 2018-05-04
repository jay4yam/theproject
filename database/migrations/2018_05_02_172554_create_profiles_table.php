<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstName');
            $table->string('fullName');
            $table->date('birthDate');
            $table->string('phoneNumber');
            $table->string('address');
            $table->string('postalCode');
            $table->string('city');
            $table->string('country');
            $table->timestamps();
        });

        Schema::table('profiles', function (Blueprint $table){
           $table->unsignedInteger('user_id');
           $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table){
            $table->dropForeign('profiles_user_id_foreign');
        });
        Schema::dropIfExists('profiles');
    }
}
