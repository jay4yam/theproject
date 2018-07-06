<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateVoyagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('voyages', function (Blueprint $table){
           $table->string('locale')->after('id');
           $table->integer('parent_id')->after('locale');
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
            $table->dropColumn('locale');
            $table->dropColumn('parent_id');
        });
    }
}
