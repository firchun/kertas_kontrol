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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'ketua_jurusan', 'dosen', 'mahasiswa'])->default('mahasiswa')->after('email');
            $table->string('npm')->nullable()->default(0)->after('role');
            $table->string('nip')->nullable()->default(0)->after('npm');
            $table->string('phone')->nullable()->default(0)->after('nip');
            $table->text('address')->nullable()->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
