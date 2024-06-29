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
        Schema::create('tbl_daily_reports', function (Blueprint $table) {
            $table->id();
            $table->enum('related_to_case',['yes','no']);
            $table->integer('case_id');
            $table->integer('client_id');
            $table->text('details');
            $table->integer('from_emp_id');
            $table->string('from_emp_name');
            $table->integer('to_emp_id');
            $table->string('to_emp_name');
            $table->integer('publisher_id');
            $table->string('publisher_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_daily_reports');
    }
};
