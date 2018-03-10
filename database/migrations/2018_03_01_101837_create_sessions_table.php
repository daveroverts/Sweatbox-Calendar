<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('student_id');
            $table->foreign('student_id')->references('id')->on('students');
            $table->date('date');
            $table->time('begin');
            $table->time('end');
            $table->text('description')->nullable();
            $table->integer('typeSession_id');
            $table->foreign('typeSession_id')->references('id')->on('session_types');
            $table->boolean('inProgress')->default(false);
            $table->dateTime('actualBegin')->nullable();
            $table->dateTime('actualEnd')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('session');
    }
}
