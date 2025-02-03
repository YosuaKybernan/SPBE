<?php

// database/migrations/xxxx_xx_xx_create_self_assessments_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelfAssessmentsTable extends Migration
{
    public function up()
    {
        Schema::create('self_assessments', function (Blueprint $table) {
            $table->id();
            $table->year('year');
            $table->integer('internal_policy');
            $table->integer('strategic_planning');
            $table->integer('information_technology');
            $table->integer('organizer');
            $table->integer('management_implementation');
            $table->integer('it_audit');
            $table->integer('administration_services');
            $table->integer('public_services');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('self_assessments');
    }
}
