<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stoks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('barang_id')->unsigned();
            $table->bigInteger('transaksi_id')->unsigned()->nullable();
            $table->integer('qty');
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->foreign('barang_id')->references('id')->on('barangs')->onUpdate('cascade');
            $table->foreign('transaksi_id')->references('id')->on('transaksis')->onUpdate('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stoks');
    }
}
