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
        Schema::create('bimbingan_hambatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_bimbingan');
            $table->foreignId('id_semester');
            $table->foreignId('id_hambatan');
            $table->timestamps();

            $table->foreign('id_bimbingan')->references('id')->on('bimbingans');
            $table->foreign('id_semester')->references('id')->on('semesters');
            $table->foreign('id_hambatan')->references('id')->on('jenis_hambatans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bimbingan_hambatans');
    }
};
