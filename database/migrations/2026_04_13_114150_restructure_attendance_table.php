<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('attendance', function (Blueprint $table) {
            // Remove old columns
            $table->dropColumn(['student_name', 'matrix_no', 'course_name']);

            // Add student_id foreign key
            $table->unsignedBigInteger('student_id')->after('attendance_id');
            $table->foreign('student_id')
                ->references('student_id')
                ->on('students')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('attendance', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->dropColumn('student_id');
            $table->string('student_name');
            $table->string('matrix_no');
            $table->string('course_name');
        });
    }
};
