<?php

// database/migrations/xxxx_xx_xx_add_excel_link_to_final_assessments_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExcelLinkToFinalAssessmentsTable extends Migration
{
    public function up()
    {
        Schema::table('final_assessments', function (Blueprint $table) {
            $table->string('excel_link')->nullable();
        });
    }

    public function down()
    {
        Schema::table('final_assessments', function (Blueprint $table) {
            $table->dropColumn('excel_link');
        });
    }
}
