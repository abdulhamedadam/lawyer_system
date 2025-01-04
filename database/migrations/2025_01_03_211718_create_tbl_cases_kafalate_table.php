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
        Schema::create('tbl_cases_kafalate', function (Blueprint $table) {
            $table->id();
            $table->integer('case_id')->nullable();
            $table->string('kafala_num')->nullable();
            $table->string('year')->nullable();
            $table->string('qasema_num')->nullable();
            $table->string('payment_date')->nullable();
            $table->string('kafala_value')->nullable();
            $table->string('paper_num')->nullable();
            $table->text('al7ukm')->nullable();
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
        Schema::dropIfExists('tbl_cases_kafalate');
    }
};
