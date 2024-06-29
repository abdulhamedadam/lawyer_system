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
        Schema::create('tbl_cases_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('ttype',['case_type','courts','case_status','sarf_band','legal_service'])->nullable();
            $table->integer('from_id');
            $table->string('color');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_cases_settings');
    }
};
