<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMentorActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentor_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
        });

        //Inserting all the types of actions that are available
        $actions = [
            ['name' => 'S1 mentor [DEL]',  'description' => "Person is a Student mentor, and is allowed to mentor Delivery [DEL] students"],
            ['name' => 'S1/S2 mentor [GND] [TWR]',  'description' => "Person is a Student 2 mentor, and is allowed to mentor Ground [GND], and Tower [TWR] students"],
            ['name' => 'S3 mentor [APP]',  'description' => "Person is a Senior Student [S3] mentor, and is allowed to mentor Approach [APP] students"],
            ['name' => 'C1 mentor [ACC]',  'description' => "Person is a Controller [C1] mentor, and is allowed to mentor Radar [ACC] students"],


        ];
        DB::table('mentor_actions')->insert($actions);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mentor_actions');
    }
}
