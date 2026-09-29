<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->increments('id_barang');
            $table->unsignedInteger('id_kategori');
            $table->string('kode_barang', 20)->unique();
            $table->string('nama_barang', 100);
            $table->text('deskripsi');
            $table->decimal('harga_sewa', 12, 2);
            $table->integer('stok');
            $table->string('foto', 255)->nullable();
            $table->enum('status', ['tersedia', 'tidak tersedia'])->default('tersedia');

            $table->foreign('id_kategori')
                ->references('id_kategori')
                ->on('kategori')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};