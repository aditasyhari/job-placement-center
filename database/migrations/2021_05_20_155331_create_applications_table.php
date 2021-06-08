<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_job')->references('id')->on('jobs');
            $table->foreignId('id_pelamar')->references('id')->on('users');
            $table->foreignId('id_company')->references('id')->on('users');
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->boolean('baca_perusahaan')->default(false);
            $table->boolean('baca_pelamar')->default(false);
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
        Schema::dropIfExists('applications');
    }
}
