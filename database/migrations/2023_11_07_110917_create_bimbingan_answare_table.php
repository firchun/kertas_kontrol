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
        Schema::create('bimbingan_answares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_bimbingan');
            $table->foreignId('id_user');
            $table->text('isi')->nullable();
            $table->timestamp('read_at');
            $table->timestamps();

            $table->foreign('id_bimbingan')->references('id')->on('bimbingans');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bimbingan_answare');
    }
};
