<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cover_id')->nullable();
            $table->unsignedBigInteger('intro_id')->nullable();
            $table->unsignedBigInteger('develop_id')->nullable();
            $table->unsignedBigInteger('conclusion_id')->nullable();
            $table->timestamps();

            $table->foreign('cover_id')->references('id')->on('boards')->onDelete('cascade');
            $table->foreign('intro_id')->references('id')->on('boards')->onDelete('cascade');
            $table->foreign('develop_id')->references('id')->on('boards')->onDelete('cascade');
            $table->foreign('conclusion_id')->references('id')->on('boards')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}