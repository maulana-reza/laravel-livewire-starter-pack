<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PrepareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tentang', function (Blueprint $table) {
            $table->id();
            $table->string('village_id')->nullable();
            $table->string('alamat')->nullable();
            $table->string('nomor_hp')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
        Schema::create('waktu_beroperasi', function (Blueprint $table) {
            $table->id();
            $table->string('hari_mulai')->nullable();
            $table->string('hari_akhir')->nullable();
            $table->time('jam_mulai')->nullable();
            $table->time('istirahat_mulai')->nullable();
            $table->time('istirahat_akhir')->nullable();
            $table->time('jam_akhir')->nullable();
            $table->timestamps();
        });
        Schema::create('kategori', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id');
            $table->string('judul_buku')->nullable();
            $table->string('penerbit')->nullable();
            $table->string('bahasa')->nullable();
            $table->string('isbn')->nullable();
            $table->timestamps();
            $table->foreign("users_id")
                ->references("id")
                ->on("users")
                ->onDelete("cascade");
        });
        Schema::create('kategori_buku', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buku_id');
            $table->foreignId('kategori_id');
            $table->timestamps();

            $table->foreign('buku_id')
                ->references('id')
                ->on('buku')
                ->onDelete("cascade");

            $table->foreign('kategori_id')
                ->on('kategori')
                ->references('id')
                ->onDelete("cascade");
        });
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId("buku_id");
            $table->string("kode_peminjaman")->nullable();
            $table->dateTime("mulai_peminjaman")->nullable();
            $table->dateTime("akhir_peminjaman")->nullable();
            $table->foreignId('users_id')->nullable();
            $table->foreignId('access_id')->comment("dari users id")->nullable();
            $table->bigInteger("denda")->nullable();
            $table->timestamps();
            $table->foreign('users_id')
                ->on('users')
                ->references('id')
                ->onDelete("cascade");
            $table->foreign('access_id')
                ->on('users')
                ->references('id')
                ->onDelete("cascade");
            $table->foreign('buku_id')
                ->on('buku')
                ->references('id')
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("peminjaman");
        Schema::dropIfExists("kategori_buku");
        Schema::dropIfExists("buku");
        Schema::dropIfExists("kategori");
        Schema::dropIfExists("waktu_beroperasi");
        Schema::dropIfExists("tentang");
        //
    }
}
