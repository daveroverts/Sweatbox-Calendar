<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('vatsim_id', 7)->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedInteger('rating_id')->default(1);
            $table->boolean('isAdmin')->default(0);

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
        DB::table('users')->insert(["name" => "Administrator", "vatsim_id" => 9999999, "email" => "admin@sweatbox.io", "password" => bcrypt('admin'), "rating_id" => 3, "isAdmin" => 1, "created_at" => NOW(), "updated_at" => NOW()]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
