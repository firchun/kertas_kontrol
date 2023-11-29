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
        Schema::create('bimbingan_hasils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_bimbingan');
            $table->string('judul');
            $table->string('isi');
            $table->timestamps();

            $table->foreign('id_bimbingan')->references('id')->on('bimbingans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bimbingan_hasils');
    }
};
