<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDashboardAssessmentsTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('dashboard_assessments');

        Schema::create('dashboard_assessments', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id');
            $table->string('form_name');
            $table->year('year');
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dashboard_assessments');
    }
}
