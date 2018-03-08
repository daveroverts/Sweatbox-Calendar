<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('shortName');
            $table->string('longName');
        });

        //Inserting all the types of sessions that are available
        $ratings = [
            ['shortName' => 'OBS', 'longName' => "Observer"],
            ['shortName' => 'S1', 'longName' => "Student"],
            ['shortName' => 'S2', 'longName' => "Student 2"],
            ['shortName' => 'S3', 'longName' => "Senior Student"],
            ['shortName' => 'C1', 'longName' => "Controller"],
            ['shortName' => 'C3', 'longName' => "Senior Controller"],
            ['shortName' => 'I1', 'longName' => "Instructor"],
            ['shortName' => 'I3', 'longName' => "Senior Instructor"],
            ['shortName' => 'SUP', 'longName' => "Supervisor"],
            ['shortName' => 'ADM', 'longName' => "Administrator"],
        ];
        DB::table('ratings')->insert($ratings);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ratings');
    }
}
