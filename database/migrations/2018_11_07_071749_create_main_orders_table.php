<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('order_id');
            $table->string('stripe_customer_id');
            $table->string('stripe_charge_id')->nullable();
            $table->string('stripe_failure_code')->nullable();
            $table->string('stripe_failure_message')->nullable();
            $table->boolean('is_paid')->default(false);
            $table->string('stripe_payment_status')->nullable();
            $table->timestamps();
        });

        Schema::table('main_orders', function (Blueprint $table){
            $table->integer('user_id')->unsigned();
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
        Schema::table('main_orders', function (Blueprint $table){
            $table->dropForeign('main_orders_user_id_foreign');
        });

        Schema::dropIfExists('main_orders');
    }
}
