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
        Schema::dropIfExists('input_texts');
    }
}
