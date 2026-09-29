<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_penyewaan', function (Blueprint $table) {
            $table->increments('id_detail');
            $table->unsignedInteger('id_penyewaan');
            $table->unsignedInteger('id_barang');
            $table->integer('jumlah');
            $table->decimal('harga_sewa', 12, 2);
            $table->decimal('subtotal', 12, 2);

            $table->foreign('id_penyewaan')
                ->references('id_penyewaan')
                ->on('penyewaan')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('id_barang')
                ->references('id_barang')
                ->on('barang')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_penyewaan');
    }
};