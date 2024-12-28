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
        Schema::table('tbl_clients_cases', function (Blueprint $table) {

            $table->integer('client_type')->nullable();
            $table->date('receiving_date')->nullable();
            $table->date('register_date')->nullable();
            $table->integer('tawkel_id')->nullable();
            $table->text('khesm_name')->nullable();
            $table->integer('khesm_type')->nullable();
            $table->text('khesm_phone')->nullable();
            $table->text('khesm_email')->nullable();
            $table->string('court_address')->nullable();
            $table->integer('lawyer')->nullable();
            $table->integer('litigation_degree')->nullable();
            $table->string('circle_name')->nullable();
            $table->text('case_subject')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_clients_cases', function (Blueprint $table) {
            //
        });
    }
};
