<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermintaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permintaan', function (Blueprint $table) {
            $table->id('id_permintaan');
            $table->date('tgl');
            $table->decimal('total_bayar', 15, 2);
            $table->text('payment');
            $table->integer('status')->comment('0=Belum diproses, 1=Diproses, 2=Dikirim, 3=Selesai');
            $table->foreignId('id_resep')->nullable()->constrained('reseps', 'id_resep');
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
        Schema::dropIfExists('permintaans');
    }
}
