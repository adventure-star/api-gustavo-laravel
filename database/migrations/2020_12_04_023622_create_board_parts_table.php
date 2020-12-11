<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_parts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inputimage_id')->nullable();
            $table->unsignedBigInteger('inputvideo_id')->nullable();
            $table->unsignedBigInteger('inputtext_id')->nullable();
            $table->unsignedBigInteger('inputquestion_id')->nullable();
            $table->unsignedBigInteger('board_id')->nullable();
            $table->timestamps();

            $table->foreign('board_id')->references('id')->on('boards')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('board_parts');
    }
}
