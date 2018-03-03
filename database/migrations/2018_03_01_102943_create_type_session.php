<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeSession extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type', function (Blueprint $table) {
            $table->increments('id');
            $table->text('typeSession');
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
            DB::table('type')->insert(
                array(
                    'typeSession' => $type
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
        Schema::dropIfExists('type');
    }
}
