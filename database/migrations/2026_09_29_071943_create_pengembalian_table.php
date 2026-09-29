<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->increments('id_pengembalian');
            $table->unsignedInteger('id_penyewaan')->unique();
            $table->date('tanggal_pengembalian');
            $table->decimal('denda', 12, 2)->default(0);
            $table->text('keterangan')->nullable();

            $table->foreign('id_penyewaan')
                ->references('id_penyewaan')
                ->on('penyewaan')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengembalian');
    }
};