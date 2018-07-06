<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeotableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seotable', function (Blueprint $table) {
            $table->increments('id');
            $table->string('locale');
            $table->string('title');
            $table->string('meta_robots');
            $table->string('meta_description');
            $table->string('canonical');
            $table->integer('seotable_id')->unsigned();
            $table->string('seotable_type');
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
        Schema::dropIfExists('seotable');
    }
}
