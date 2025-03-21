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
        Schema::create('tbl_cases_files', function (Blueprint $table) {
            $table->id();
            $table->integer('case_id_fk');
            $table->string('file_name');
            $table->string('file');
            $table->integer('publisher');
            $table->string('publisher_n');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_cases_files');
    }
};
