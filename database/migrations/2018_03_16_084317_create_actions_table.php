<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
        });

        //Inserting all the types of actions that are available
        $actions = [
            ['name' => 'readyS1Test',  'description' => "S1 test can now be issued"],
            ['name' => 'readyDELTest',  'description' => "Delivery test can now be issued"],
            ['name' => 'controlDEL',  'description' => "Person is allowed to control on Delivery [DEL]"],
            ['name' => 'finishDEL',  'description' => "Delivery can now be finished"],
            ['name' => 'controlEventDEL',  'description' => "Person is allowed to control on Delivery [DEL] on events"],
            ['name' => 'controlBigEventDEL',  'description' => "Person is allowed to control on Delivery on busy events (FNFI,CTP)"],
            ['name' => 'controlGND',  'description' => "Person is allowed to control on Ground [GND]"],
            ['name' => 'readyGNDExam',  'description' => "Ground exam can now be requested"],
            ['name' => 'controlEventGND',  'description' => "Person is allowed to control on Ground [GND] on small events"],
            ['name' => 'controlBigEventGND',  'description' => "Person is allowed to control on Ground [GND] on busy events (FNFI, CTP)"],
            ['name' => 'controlTWR',  'description' => "Person is Solo-Validated for Tower [TWR], and allowed to control on Tower [TWR]"],
            ['name' => 'controlEventTWR',  'description' => "Person is allowed to control on Tower [TWR] on small events"],
            ['name' => 'controlBigEventTWR',  'description' => "Person is allowed to control on Tower [TWR] on busy events (FNFI, CTP)"],
            ['name' => 'readyS2Test',  'description' => "S2 test can now be issued"],
            ['name' => 'readyTWRExam',  'description' => "TWR CPT can now be requested"],
            ['name' => 'becomeS1Mentor',  'description' => "Person can sign up to become a mentor for Delivery [DEL], Ground [GND], and Tower [TWR] students"],
            ['name' => 'controlAPP',  'description' => "Person is Solo-Validated for Approach [APP], and allowed to control on Approach [APP]"],
            ['name' => 'controlEventAPP',  'description' => "Person is allowed to control Approach [APP] on small events"],
            ['name' => 'controlEventBigAPP',  'description' => "Person is allowed to control on Approach [APP] on busy events (FNFI, CTP)"],
            ['name' => 'readyAPPPreCPT',  'description' => "Approach Pre-CPT can now be requested"],
            ['name' => 'readyS3Test',  'description' => "S3 test can now be issued"],
            ['name' => 'readyAPPExam',  'description' => "Approach CPT can now be requested"],
            ['name' => 'becomeS2Mentor',  'description' => "Person can sign up to become a mentor for Approach [APP] students"],
            ['name' => 'controlACC',  'description' => "Person is SOlo-Validated for Radar [ACC], and allowed to control Radar [ACC]"],
            ['name' => 'controlEventACC',  'description' => "Person is allowed to control Radar [ACC] on small events"],
            ['name' => 'controlBigEventACC',  'description' => "Person is allowed to control Radar [ACC] on busy events (FNFI, CTP)"],
            ['name' => 'readyACCPreCPT',  'description' => "Radar Pre-CPT can now be requested"],
            ['name' => 'readyC1Test',  'description' => "C1 test can now be issued"],
            ['name' => 'readyACCCPT',  'description' => "Radar CPT can now be requested"],
            ['name' => 'becomeS3Mentor',  'description' => "Person can sign up to become a mentor for Radar [ACC] students"],


        ];
        DB::table('actions')->insert($actions);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actions');
    }
}
