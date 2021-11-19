<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSubjek extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjek', function (Blueprint $table) {
            $table->id();
            $table->string("nama");
            $table->timestamps();
        });
        Schema::create('subjek_buku', function (Blueprint $table) {
            $table->id();
            $table->foreignId("buku_id");
            $table->foreignId("subjek_id");
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
        Schema::dropIfExists('table_subjek');
    }
}
