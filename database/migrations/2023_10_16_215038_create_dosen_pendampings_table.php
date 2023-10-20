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
        Schema::create('dosen_pendampings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mahasiswa');
            $table->foreignId('id_dosen');
            $table->timestamps();

            $table->foreign('id_mahasiswa')->references('id')->on('users');
            $table->foreign('id_dosen')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dosen_pendampings');
    }
};
