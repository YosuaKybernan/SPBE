<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('domain_manajemens', function (Blueprint $table) {
            $table->id();
            $table->string('aspect_name'); // Nama Aspek
            $table->json('indicators'); // Indikator dalam bentuk JSON untuk mendukung banyak indikator
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('domain_manajemens');
    }
};
