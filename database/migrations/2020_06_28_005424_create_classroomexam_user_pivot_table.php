<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomexamUserPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroomexam_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classroom_exam_id')->constrained('classroom_exam');
            $table->foreignId('user_id')->constrained();
            $table->integer('attempt')->nullable();
            $table->datetime('waktu_mulai');
            $table->datetime('waktu_selesai')->nullable();
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
        Schema::dropIfExists('classroomexam_user');
    }
}
