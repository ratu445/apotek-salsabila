<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analisis', function (Blueprint $table) {
            $table->id('id_analisis');
            $table->foreignId('id_barang')->constrained('barangs', 'id_barang');
            $table->integer('dt_jml_permintaan')->comment('Jumlah permintaan dalam periode');
            $table->integer('biaya_pemesanan')->comment('Dalam rupiah');
            $table->integer('biaya_penyimpanan')->comment('Dalam rupiah per unit per periode');
            $table->integer('hari_aktif')->comment('Hari aktif dalam satu periode');
            $table->integer('periode')->comment('Jumlah periode data');
            $table->double('eoq')->comment('Economic Order Quantity');
            $table->double('rop')->comment('Reorder Point');
            $table->integer('safety_stok');
            $table->integer('minimal_stok');
            $table->integer('maksimal_stok');
            $table->integer('lead_time')->comment('Waktu tunggu pesanan (dalam hari)');
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
        Schema::dropIfExists('analises');
    }
}
