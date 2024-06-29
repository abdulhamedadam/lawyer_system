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
            $table->integer('client_id_fk');
            $table->string('case_name');
            $table->integer('case_num');
            $table->integer('case_type_fk');
            $table->integer('court_id_fk');
            $table->decimal('fees');
            $table->string('start_date');
            $table->string('end_date');
            $table->integer('case_status');
            //$table->enum('status', ['inactive', 'active'])->default('active');
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
