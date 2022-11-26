<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_customer');
            $table->string('no_hp');
            $table->string('jumlah_orang');
            $table->string('nama_kamar');
            $table->date('tanggal_reservasi');
            $table->date('tanggal_kepulangan');
            $table->string('jumlah_hari');
            $table->float('harga_kamar');
            $table->float('total');
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
        Schema::dropIfExists('reservasis');
    }
};