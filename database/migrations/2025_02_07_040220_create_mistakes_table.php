<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMistakesTable extends Migration
{
    public function up()
    {
        Schema::create('mistakes', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->enum('status', ['declined', 'pending', 'acknowledged', 'fixed'])->default('pending');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mistakes');
    }
}
