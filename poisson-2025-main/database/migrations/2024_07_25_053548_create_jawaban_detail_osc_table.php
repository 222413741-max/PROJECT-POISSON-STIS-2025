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
        Schema::create('jawaban_detail_osc', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jawaban_osc_id');
            $table->foreignId('soal_id');
            $table->string('answer', 2)->nullable();
            $table->enum('status', [0, 1])->comments('0: salah, 1: benar')->nullable();
            $table->integer('point');

            $table->timestamps();

            $table->foreign('jawaban_osc_id')->references('id')->on('jawaban_osc')->onDelete('cascade');
            $table->foreign('soal_id')->references('id')->on('soal_osc')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jawaban_detail_osc');
    }
};
