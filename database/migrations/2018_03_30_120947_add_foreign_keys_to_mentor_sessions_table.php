<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToMentorSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mentor_sessions', function (Blueprint $table) {
            $table->foreign('mentor_id')->references('id')->on('mentors');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('typeSession_id')->references('id')->on('session_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mentor_sessions', function (Blueprint $table) {
            $table->dropForeign(['mentor_id']);
            $table->dropForeign(['student_id']);
            $table->dropForeign(['typeSession_id']);
        });
    }
}
