<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->unsignedInteger('following_id');
            $table->unsignedInteger('followed_id');

            // following_idとfollowed_idが同じ値を持たないように
            // ①indexメソッドに配列を渡し、
            // ②カラム定義にuniqueメソッドを追加する。
            $table->index([
              'following_id',
              'followed_id'
            ]);

            $table->unique([
              'following_id',
              'followed_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follows');
    }
}
