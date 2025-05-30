<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->string('caption', 100)->nullable();
            $table->text('description');
            $table->boolean('show_upside')->default(false);
            $table->text('upside')->nullable();
            $table->boolean('show_downside')->default(false);
            $table->text('downside')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('items');
    }
}
