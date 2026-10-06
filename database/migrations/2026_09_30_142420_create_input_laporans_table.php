<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('input_laporan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('no_bukti')->nullable();
            $table->string('kode')->nullable();
            $table->string('uraian');
            $table->enum('kategori', ['honor_konsultan', 'honor_panitia_petukang', 'belanja_material', 'mutasi'])->default('belanja_material');
            $table->enum('status', ['panitia', 'pekerja'])->nullable();
            $table->enum('mutasi', ['masuk', 'keluar', 'tarik'])->default('keluar');
            $table->enum('metode_pembayaran', ['tunai', 'transfer'])->default('tunai');
            $table->enum('realisasi_anggaran', ['Y', 'N'])->default('N');
            $table->integer('nominal');
            $table->string('bukti')->nullable();
            $table->foreignId('toko_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('input_laporan');
    }
};
