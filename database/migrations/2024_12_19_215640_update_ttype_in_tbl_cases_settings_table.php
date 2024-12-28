<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tbl_cases_settings', function (Blueprint $table) {
            $table->enum('ttype', [
                'case_type',
                'courts',
                'case_status',
                'sarf_band',
                'legal_service',
                'tawkel_type',
                'mawkel_type',
                'litigation_degree',
                'administrative_work',
                'cash_boxes',
            ])->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_cases_settings', function (Blueprint $table) {
            $table->enum('ttype', [
                'case_type',
                'courts',
                'case_status',
                'sarf_band',
                'legal_service'
            ])->nullable()->change();
        });
    }
};
