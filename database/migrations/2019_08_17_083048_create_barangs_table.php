<?php
 
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama', 50);
            $table->string('foto')->nullable();
            $table->boolean('kondisi');
            $table->boolean('status')->default(1);
            $table->smallInteger('kategori_id')->unsigned();
            $table->smallInteger('lokasi_id')->unsigned();
            $table->integer('harga')->nullable();
            $table->tinyInteger('satuan_id')->unsigned();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('lokasi_id')->references('id')->on('lokasis')
            ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangs');
    }
}
