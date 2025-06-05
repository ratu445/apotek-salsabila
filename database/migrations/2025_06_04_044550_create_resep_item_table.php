<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResepItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resep_item', function (Blueprint $table) {
            $table->id('id_resep_item');
            $table->foreignId('id_resep')->constrained('reseps', 'id_resep');
            $table->foreignId('id_barang')->constrained('barangs', 'id_barang');
            $table->integer('jumlah');
            $table->text('aturan_pakai');
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
        Schema::dropIfExists('resep_items');
    }
}
