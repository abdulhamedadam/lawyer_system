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
        Schema::create('tbl_hr_attendance', function (Blueprint $table) {
            $table->id();
            $table->string('attendance_date',15)->nullable();
            $table->string('month',10)->nullable();
            $table->string('year',10)->nullable();
            $table->integer('publisher_id')->nullable();
            $table->string('publisher_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_hr_attendance');
    }
};
