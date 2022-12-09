<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kategori')->constrained('kategori_bukus');
            $table->string('penerbit')->constrained('penerbit_bukus');
            $table->string('pengarang');
            $table->integer('tahun_terbit');
            $table->integer('isbn');
            $table->integer('jumlah_buku');
            $table->string('rak_buku');
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
        Schema::dropIfExists('bukus');
    }
};
