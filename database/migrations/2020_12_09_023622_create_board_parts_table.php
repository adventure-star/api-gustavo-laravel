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
            $table->timestamps();

            $table->foreign('inputimage_id')->references('id')->on('input_images')->onDelete('cascade');
            $table->foreign('inputvideo_id')->references('id')->on('input_videos')->onDelete('cascade');
            $table->foreign('inputtext_id')->references('id')->on('input_texts')->onDelete('cascade');
            $table->foreign('inputquestion_id')->references('id')->on('input_questions')->onDelete('cascade');
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
