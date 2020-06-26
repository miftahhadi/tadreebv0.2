<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatesClassroomExamPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom_exam', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classroom_id')->constrained();
            $table->foreignId('exam_id')->constrained();
            $table->tinyInteger('tampil')->nullable();
            $table->tinyInteger('buka')->nullable();
            $table->tinyInteger('buka_hasil')->nullable();
            $table->dateTime('tampil_otomatis')->nullable();
            $table->dateTime('buka_otomatis')->nullable();
            $table->dateTime('batas_buka')->nullable();
            $table->integer('durasi')->nullable();
            $table->integer('attempt')->nullable();
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
        Schema::dropIfExists('classroom_exam');
    }
}
