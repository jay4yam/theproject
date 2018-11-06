<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('order_id');
            $table->integer('voyage_id');
            $table->string('voyage_name');
            $table->integer('num_of_passenger')->default(1);
            $table->double('prix_unitaire');
            $table->double('prix_final');
            $table->date('date_voyage');
            $table->string('stripe_charge_id')->nullable();
            $table->string('stripe_failure_code')->nullable();
            $table->string('stripe_failure_message')->nullable();
            $table->boolean('is_paid')->default(false);
            $table->string('stripe_payment_status')->nullable();

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
        Schema::table('orders', function (Blueprint $table){
            $table->dropForeign('orders_user_id_foreign');
        });

        Schema::dropIfExists('orders');
    }
}
