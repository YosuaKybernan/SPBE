<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRegulationsTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('regulations');

        Schema::create('regulations', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('title');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('regulations');
    }
}
