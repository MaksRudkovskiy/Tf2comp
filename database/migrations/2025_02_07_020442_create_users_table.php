<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 25);
            $table->string('email', 50)->unique();
            $table->string('password', 255);
            $table->binary('avatar')->nullable();
            $table->tinyInteger('role')->default(0)->comment('0 - user, 1 - admin, 2 - moderator');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}

