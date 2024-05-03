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
        Schema::table('jenis_hambatans', function (Blueprint $table) {
            $table->foreignId('id_layanan')->default(2)->after('id');

            $table->foreign('id_layanan')->references('id')->on('layanans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jenis_hambatans', function (Blueprint $table) {
            //
        });
    }
};
