<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('nama_aplikasi');
            $table->string('skpd_pemilik');
            $table->string('jenis_layanan');
            $table->string('spesifikasi_layanan')->nullable();
            $table->string('alamat_website')->nullable();
            $table->string('nama_pic');
            $table->string('kontak_wa');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('applications');
    }
};
