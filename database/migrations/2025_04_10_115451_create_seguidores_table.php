<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeguidoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguidores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seguidor_id')->constrained('usuarios')->onDelete('cascade');
            $table->foreignId('seguindo_id')->constrained('usuarios')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['seguidor_id', 'seguindo_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seguidores');
    }
}
