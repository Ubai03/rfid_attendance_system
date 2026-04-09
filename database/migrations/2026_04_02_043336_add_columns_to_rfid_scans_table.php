<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('rfid_scans', function (Blueprint $table) {
            $table->string('student_name')->nullable()->after('rfid_uid');
            $table->string('matrix_no')->nullable()->after('student_name');
            $table->string('course_name')->nullable()->after('matrix_no');
        });
    }

    public function down(): void
    {
        Schema::table('rfid_scans', function (Blueprint $table) {
            $table->dropColumn(['student_name', 'matrix_no', 'course_name']);
        });
    }
};
