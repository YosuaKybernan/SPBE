<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('job')->nullable()->after('name');
            $table->text('address')->nullable()->after('job');
            $table->string('phone')->nullable()->after('address');
            $table->string('profile_picture')->nullable()->after('phone');
            $table->string('facebook_url')->nullable()->after('profile_picture');
            $table->string('instagram_url')->nullable()->after('facebook_url');
            $table->string('linkedin_url')->nullable()->after('instagram_url');
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
            $table->dropColumn(['job', 'address', 'phone', 'profile_picture', 'facebook_url', 'instagram_url', 'linkedin_url']);
        });
    }
}
