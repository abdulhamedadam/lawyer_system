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
        Schema::create('tbl_legal_services', function (Blueprint $table) {
            $table->id();
            $table->string('client_name')->nullable();
            $table->unsignedBigInteger('type_of_service');
            $table->bigInteger('esnad_to')->nullable();
            $table->integer('cost_of_service')->nullable();
            $table->string('notes')->nullable();
            $table->string('legal_services_file')->nullable();
            $table->string('date_st',15)->nullable();
            $table->string('date_ar',15)->nullable();
            $table->string('time_ar',10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_services');
    }
};
