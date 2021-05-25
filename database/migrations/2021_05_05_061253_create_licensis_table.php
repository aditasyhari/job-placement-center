<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licensis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('penerbit');
            $table->year('thn_terbit');
            $table->year('thn_expired')->nullable();
            $table->boolean('is_expired');
            $table->string('file');
            $table->foreignId('id_user')->references('id')->on('users');
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
        Schema::dropIfExists('licensis');
    }
}
