<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('voyage_id');
            $table->string('voyage_name');
            $table->integer('num_of_passenger')->default(1);
            $table->double('prix_unitaire');
            $table->double('prix_final');
            $table->date('date_voyage');

            $table->integer('main_order_id')->unsigned();
            $table->foreign('main_order_id')->references('id')->on('main_orders');
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
        Schema::table('items_order', function (Blueprint $table){
            $table->dropForeign('items_order_main_order_id_foreign');
        });

        Schema::dropIfExists('items_order');
    }
}
