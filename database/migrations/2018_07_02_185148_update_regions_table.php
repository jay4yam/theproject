<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('regions', function (Blueprint $table){
            $table->string('title')->after('name');
            $table->string('subtitle')->after('title');
            $table->text('description')->after('subtitle');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('regions', function (Blueprint $table){
            $table->dropColumn('title');
            $table->dropColumn('subtitle');
            $table->dropColumn('description');
        });
    }
}
