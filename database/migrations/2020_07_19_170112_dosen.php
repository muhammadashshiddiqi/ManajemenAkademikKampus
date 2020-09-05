<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Dosen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dosen', function (Blueprint $table) {
            $table->string('dsn_code', 10)->primary();
            $table->string('dsn_nama', 50);
            $table->string('dsn_hp', 13);
            $table->string('dsn_kelamin', 1);
            $table->string('dsn_avatar', 255);
            $table->integer('dsn_user');
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
        Schema::table('dosen', function (Blueprint $table) {
            //
        });
    }
}
