<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToMentorAllowedActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mentor_allowed_actions', function (Blueprint $table) {
            $table->foreign('mentor_id')->references('user_id')->on('mentors');
            $table->foreign('action_id')->references('id')->on('mentor_actions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mentor_allowed_actions', function (Blueprint $table) {
            $table->dropForeign('mentor_id');
            $table->dropForeign('action_id');
        });
    }
}
