<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateVillesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('villes', function (Blueprint $table){
           $table->string('title')->after('longitude')->nullable();
            $table->string('subtitle')->after('title')->nullable();
           $table->text('description')->after('subtitle')->nullable();
           $table->string('main_photo')->after('description')->nullable();
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
            $table->dropColumn('title');
            $table->dropColumn('subtitle');
            $table->dropColumn('description');
            $table->dropColumn('main_photo');
        });
    }
}
