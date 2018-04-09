<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMentorSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentor_sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('mentor_id')->index();
            $table->unsignedInteger('student_id')->index();
            $table->date('date');
            $table->time('begin');
            $table->time('end');
            $table->text('description')->nullable();
            $table->unsignedInteger('typeSession_id')->index();
            $table->boolean('inProgress')->default(false);
            $table->dateTime('actualBegin')->nullable();
            $table->dateTime('actualEnd')->nullable();
            $table->text('sessionReport')->nullable();
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
        Schema::dropIfExists('mentor_sessions');
    }
}
