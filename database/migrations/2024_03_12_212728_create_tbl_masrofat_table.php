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
        Schema::create('tbl_masrofat', function (Blueprint $table) {
            $table->id();
            $table->enum('related_to_case',['yes','no'])->nullable();
            $table->integer('case_id')->nullable();
            $table->integer('band_id')->nullable();
            $table->string('value')->nullable();
            $table->integer('emp_id')->nullable();
            $table->text('notes')->nullable();
            $table->string('sarf_date')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
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
        Schema::dropIfExists('tbl_masrofat');
    }
};
