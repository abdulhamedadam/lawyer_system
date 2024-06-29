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
        Schema::create('tbl_cases_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('session_title')->nullable();
            $table->integer('case_id')->nullable();
            $table->integer('court_id')->nullable();
            $table->string('session_judge')->nullable();
            $table->integer('emp_id')->nullable();
            $table->string('session_date')->nullable();
            $table->string('session_time')->nullable();
            $table->text('session_requirements')->nullable();
            $table->text('session_notes')->nullable();
            $table->text('session_results')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_cases_sessions');
    }
};
