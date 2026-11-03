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
        Schema::create('jawaban_semifinal_osc', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('soal_id');
            $table->string('tahap', 20);
            $table->string('url')->nullable();
            $table->timestamp('uploaded_at')->nullable();
            $table->timestamps();

            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('soal_id')->references('id')->on('soal_semifinal_osc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jawaban_semifinal_osc');
    }
};
