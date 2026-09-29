<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->increments('id_pembayaran');
            $table->unsignedInteger('id_penyewaan')->unique();
            $table->date('tanggal_pembayaran')->nullable();
            $table->decimal('jumlah_bayar', 12, 2);
            $table->string('metode_pembayaran', 50);
            $table->enum('status_pembayaran', [
                'belum_bayar',
                'menunggu_verifikasi',
                'lunas'
            ])->default('belum_bayar');

            $table->foreign('id_penyewaan')
                ->references('id_penyewaan')
                ->on('penyewaan')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};