<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
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

        Schema::table('students', function (Blueprint $table) {
            $table->foreign('mentor_id')->references('id')->on('users');
            $table->foreign('rating_id')->references('id')->on('ratings');
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

        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['mentor_id']);
            $table->dropForeign(['rating_id']);
        });
    }
}
