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
        Schema::create('tbl_clients_cases', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id_fk')->nullable();
            $table->string('case_name')->nullable();
            $table->integer('case_num')->nullable();
            $table->integer('case_type_fk')->nullable();
            $table->integer('court_id_fk')->nullable();
            $table->decimal('fees')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->integer('case_status')->nullable();
            $table->integer('notes')->nullable();
            $table->enum('status', ['inactive', 'active'])->default('active')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_clients_cases');
    }
};
