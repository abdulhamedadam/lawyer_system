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
        Schema::create('tbl_cases_experts', function (Blueprint $table) {
            $table->id();
            $table->integer('expert_num');
            $table->integer('year');
            $table->integer('case_id')->nullable();
            $table->string('expert_name');
            $table->date('visit_date')->nullable();
            $table->string('lawyer')->nullable();
            $table->text('notes')->nullable();
            $table->date('delivery_date')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_cases_experts');
    }
};
