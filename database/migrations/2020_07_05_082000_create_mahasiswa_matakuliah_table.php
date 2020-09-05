<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMahasiswaMatakuliahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa_matakuliah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mahasiswa_id', 10);
            $table->string('matkul_id', 10);
            $table->decimal('harian', 8,2);
            $table->decimal('uts', 8,2);
            $table->decimal('uas', 8,2);
            $table->decimal('total', 8,2);
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
        Schema::dropIfExists('mahasiswa_matakuliah');
    }
}
