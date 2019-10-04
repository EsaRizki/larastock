<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBadanUsahasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('badan_usahas', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('nama', 10);
            $table->timestamps();
        });

        Schema::table('gedungs', function (Blueprint $table) {
            
            $table->foreign('badan_usaha_id')->references('id')->on('badan_usahas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('badan_usahas');
    }
}
