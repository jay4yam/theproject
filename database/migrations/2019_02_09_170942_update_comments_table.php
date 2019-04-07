<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table){
           $table->string('genre_avatar')->default('/users/default-avatar.png')->after('commentable_type');
           $table->uuid('main_order_id')->nullable()->after('genre_avatar');
           $table->string('user_name_for_comment')->nullable()->after('main_order_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table){
            $table->dropColumn('genre_avatar');
            $table->dropColumn('main_order_id');
            $table->dropColumn('user_name_for_comment');
        });
    }
}
