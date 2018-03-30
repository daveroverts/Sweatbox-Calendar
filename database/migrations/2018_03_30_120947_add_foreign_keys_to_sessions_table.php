<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sessions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::table('sessions', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['student_id']);
            $table->dropForeign(['typeSession_id']);
        });
    }
}
