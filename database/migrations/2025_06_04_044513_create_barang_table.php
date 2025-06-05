<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id('id_barang');
            $table->foreignId('id_kategori')->constrained('kategoris', 'id_kategori');
            $table->foreignId('id_supplier')->constrained('suppliers', 'id_supplier');
            $table->string('kode_barang', 20);
            $table->string('nama_barang', 125);
            $table->string('keterangan', 50)->comment('Satuan produk (tablet, botol, tube, etc.)');
            $table->decimal('harga', 15, 2);
            $table->integer('stok');
            $table->date('expired_date')->nullable();
            $table->string('produsen', 125)->nullable();
            $table->text('komposisi')->nullable();
            $table->text('gambar');
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
        Schema::dropIfExists('barangs');
    }
}
