<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratJalansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_jalans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('transaksi_id')->unsigned();
            $table->string('no_surat', 30);
            $table->string('pengirim', 30);
            $table->boolean('jenis');
            $table->string('hp', 14);
            $table->string('no_polisi', 15);
            $table->timestamps();

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
        Schema::dropIfExists('surat_jalans');
    }
}
