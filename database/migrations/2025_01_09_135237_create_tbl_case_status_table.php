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
        Schema::create('tbl_case_status', function (Blueprint $table) {
            $table->id();
            $table->integer('case_id')->nullable();
            $table->integer('code')->nullable();
            $table->integer('year')->nullable();
            $table->integer('case_status_id')->nullable();
            $table->integer('lawyer_id')->nullable();
            $table->integer('case_archive_id')->nullable();
            $table->text('reasons')->nullable();
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
        Schema::dropIfExists('tbl_case_status');
    }
};
