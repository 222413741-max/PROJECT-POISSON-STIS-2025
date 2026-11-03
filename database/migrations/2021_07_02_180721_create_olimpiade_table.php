<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOlimpiadeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('olimpiade', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('soal_id');
            $table->string('tahap', 20);
            $table->string('url')->nullable();
            $table->timestamp('uploaded_at')->nullable();
            $table->timestamps();

            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('soal_id')->references('id')->on('soal');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('olimpiade');
    }
}
