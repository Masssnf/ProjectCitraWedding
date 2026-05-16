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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('id_paket');
            $table->string('kode_invoice');
            $table->string('lokasi_acara');
            $table->integer('id_client');
            $table->date('tanggal');
            $table->date('tanggal_acara');
            $table->integer('biaya_tambahan')->nullable();
            $table->enum('status',['Baru Booking','Selesai','Dibatalkan','Persiapan']);
            $table->enum('pembayaran',['Dana Pertama','Lunas']);
            $table->string('id_user');
            $table->integer('total_bayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
