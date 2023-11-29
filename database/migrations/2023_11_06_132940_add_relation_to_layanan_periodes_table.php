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
        Schema::table('layanan_periodes', function (Blueprint $table) {
            $table->foreign('id_layanan')->references('id')->on('layanans');
            $table->foreign('id_semester')->references('id')->on('semesters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('layanan_periodes', function (Blueprint $table) {
            //
        });
    }
};
