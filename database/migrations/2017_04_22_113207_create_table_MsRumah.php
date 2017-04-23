<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMsRumah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msRumah', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alamat')->unique();
            $table->string('kondisi');
            $table->text('keterangan')->nullable();
            $table->integer('tipe_rumah_id');
            $table->integer('is_available')->default(1);
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
        Schema::dropIfExists('msRumah');
    }
}
