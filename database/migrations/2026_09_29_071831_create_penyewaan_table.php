<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penyewaan', function (Blueprint $table) {
            $table->increments('id_penyewaan');
            $table->string('kode_penyewaan', 20)->unique();
            $table->unsignedInteger('id_user');
            $table->date('tanggal_sewa');
            $table->date('tanggal_rencana_kembali');
            $table->decimal('total_harga', 12, 2);
            $table->enum('jenis_pengambilan', ['diambil', 'dikirim']);
            $table->enum('status', [
                'menunggu',
                'disetujui',
                'ditolak',
                'dibayar',
                'berlangsung',
                'pengembalian',
                'selesai',
                'dibatalkan'
            ])->default('menunggu');
            $table->timestamps();

            $table->foreign('id_user')
                ->references('id_user')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penyewaan');
    }
};