<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangPermintaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_permintaan', function (Blueprint $table) {
            $table->id('id_bp');
            $table->foreignId('id_permintaan')->constrained('permintaans', 'id_permintaan');
            $table->foreignId('id_barang')->constrained('barangs', 'id_barang');
            $table->integer('jumlah');
            $table->decimal('harga_satuan', 15, 2);
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
        Schema::dropIfExists('barang_permintaans');
    }
}
