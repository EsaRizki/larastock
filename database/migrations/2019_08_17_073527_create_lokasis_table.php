<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateLokasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ 
    public function up()
    {
        Schema::create('lokasis', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('nama', 50)->unique();
            $table->unsignedSmallInteger('lokasi_id')->nullable();
            $table->timestamps();

            $table->foreign('lokasi_id')->references('id')->on('lokasis')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lokasis');
    }
}
