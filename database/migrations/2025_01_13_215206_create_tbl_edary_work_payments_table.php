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
        Schema::create('tbl_edary_work_payments', function (Blueprint $table) {
            $table->id();
            $table->date('paid_date')->nullable();
            $table->integer('edary_work_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->string('person_name')->nullable();
            $table->string('person_phone')->nullable();
            $table->decimal('paid_value')->nullable();
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('tbl_edary_work_payments');
    }
};
