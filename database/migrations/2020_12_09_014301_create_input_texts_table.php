<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('input_texts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('fontfamily')->nullable();
            $table->string('fontsize')->nullable();
            $table->string('textcolor')->nullable();
            $table->string('bgcolor')->nullable();
            $table->unsignedBigInteger('board_part_id')->nullable();
            $table->timestamps();

            $table->foreign('board_part_id')->references('id')->on('board_parts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('input_texts');
    }
}
