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
        Schema::create('tbl_hr_attendance_details', function (Blueprint $table) {
            $table->id();
            $table->integer('attendance_id')->nullable();
            $table->integer('emp_id')->nullable();
            $table->string('attendance_time',10)->nullable();
            $table->string('leave_time',10)->nullable();
            $table->enum('attendance_status',['present','absent','holiday','late'])->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_hr_attendance_details');
    }
};
