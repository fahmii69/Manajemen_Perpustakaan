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
        Schema::create('peminjaman_bukus', function (Blueprint $table) {
            $table->id();
            // $table->integer('jumlah')->unsigned();
            // $table->string('judul')->references('id')->constrained('bukus');
            $table->string('nama_siswa')->constrained('siswas');
            $table->foreignId('buku_id')->constrained('bukus');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    // Schema::create('transaksi', function (Blueprint $table) {
    //     $table->id();
    //     $table->string('kode_transaksi');
    //     $table->date('tgl_pinjam');
    //     $table->date('tgl_kembali');
    //     $table->enum('status',['pinjam','kembali']);
    //     $table->text('ket')->nullable();
    //     $table->foreignId('anggota_id')->constrained('anggota');
    //     $table->foreignId('buku_id')->constrained('buku');
    //     $table->foreignId('user_id')->constrained('users');
    //     $table->timestamps();
    //     $table->softDeletes();
    // });

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman_bukus');
    }
};
