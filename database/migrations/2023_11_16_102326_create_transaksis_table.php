<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->increments('id_trans');
            $table->decimal('nominal', 10, 0);
            $table->text('deskripsi');
            $table->date('tanggal');
        });

        Schema::table('transaksis', function (Blueprint $table) {
            $table->integer('kategori_id')
            ->index() // index
            ->unsigned()
            ->after('id_trans');

            $table->foreign('kategori_id') //foreignKey
            ->references('id_ket') // dari kolom id_ket
            ->on('kategoris') // di tabel kategori
            ->onUpdate('cascade') // ketika terjadi perubahan di tabel jasa maka akan update
            ->onDelete('cascade'); // ketika data kategori di hapus akan ikut hilang
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
