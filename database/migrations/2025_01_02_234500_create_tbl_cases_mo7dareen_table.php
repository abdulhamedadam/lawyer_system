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
        Schema::create('tbl_cases_mo7dareen', function (Blueprint $table) {
            $table->id();
            $table->integer('case_id')->nullable();
            $table->string('mo7dareen_num')->nullable();
            $table->string('year')->nullable();
            $table->integer('lawyer')->nullable();
            $table->string('mo7dareen_pen')->nullable();
            $table->string('session_date')->nullable();
            $table->string('delivery_date')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('tbl_cases_mo7dareen');
    }
};
