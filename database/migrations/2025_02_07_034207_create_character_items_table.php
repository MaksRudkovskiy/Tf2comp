<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacterItemsTable extends Migration
{
    public function up()
    {
        Schema::create('character_items', function (Blueprint $table) {
            $table->foreignId('characters_id')->constrained()->onDelete('cascade');
            $table->foreignId('items_id')->constrained('items')->onDelete('cascade');
            $table->primary(['characters_id', 'items_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('character_items');
    }
}
