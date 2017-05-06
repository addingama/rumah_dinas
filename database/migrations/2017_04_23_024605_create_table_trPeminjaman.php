<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTrPeminjaman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msPeminjaman', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pegawai_id');
            $table->integer('rumah_id');
            $table->double('harga_sewa');
            $table->string('terbilang');
            $table->date('start');
            $table->date('end');
            $table->string('dasar_pelaksanaan_tarif_sewa');
            $table->string('tempat_pembayaran');
            $table->integer('is_returned')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('msPeminjaman');
    }
}
