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
        Schema::create('tbl_case_tanfiz_a7kam', function (Blueprint $table) {
            $table->id();
            $table->integer('partial_num')->nullable();
            $table->integer('year')->nullable();
            $table->integer('case_id')->nullable();
            $table->string('tanfiz_circle')->nullable();
            $table->string('elkady_name')->nullable();
            $table->string('elmarkaz')->nullable();
            $table->date('el7okm_date')->nullable();
            $table->integer('court')->nullable();
            $table->text('el7okm')->nullable();
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
        Schema::dropIfExists('tbl_case_tanfiz_a7kam');
    }
};
