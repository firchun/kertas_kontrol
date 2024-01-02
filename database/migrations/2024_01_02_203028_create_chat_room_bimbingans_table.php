<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_room_bimbingans', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('chat_room_id');
            $table->foreignId('id_bimbingan');
            $table->foreignId('id_user');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_bimbingan')->references('id')->on('bimbingans');
            $table->foreign('chat_room_id')->references('id')->on('chat_rooms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_room_bimbingans');
    }
};
