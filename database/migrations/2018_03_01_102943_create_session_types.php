<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_types', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
        });

        //Inserting all the types of sessions that are available
        $types = [
            "Delivery",
            "Ground",
            "Ground Exam",
            "Tower",
            "Approach",
            "Approach Pre-CPT",
            "ACC",
            "ACC Pre-CPT",
        ];
        foreach ($types as $type){
            DB::table('session_types')->insert(
                array(
                    'name' => $type
                )
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('session_types');
    }
}
