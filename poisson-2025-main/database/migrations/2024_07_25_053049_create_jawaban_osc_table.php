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
        Schema::create('jawaban_osc', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('package', 2);
            $table->enum('status', [0, 1, 2])->comments('0: blm mengerjakan, 1: sedang mengerjakan, 2: selesai mengerjakan');
            $table->integer('total_points')->nullable();
            $table->dateTime('time_over');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jawaban_osc');
    }
};
