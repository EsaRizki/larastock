<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_transaksi', function (Blueprint $table) {
            $table->bigInteger('barang_id')->unsigned()->index();
            $table->foreign('barang_id')->references('id')->on('barangs')->onDelete('cascade');
            $table->bigInteger('transaksi_id')->unsigned()->index();
            $table->foreign('transaksi_id')->references('id')->on('transaksis')->onDelete('cascade');
            $table->primary(['barang_id', 'transaksi_id']);
            $table->integer('qty');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_transaksi');
    }
}
