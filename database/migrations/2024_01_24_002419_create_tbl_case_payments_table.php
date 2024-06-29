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
        Schema::create('tbl_case_payments', function (Blueprint $table) {
            $table->id();
            $table->string('paid_date',15)->nullable();
            $table->string('paid_time',10)->nullable();
            $table->decimal('paid_value')->nullable();
            $table->string('year')->nullable();
            $table->string('month')->nullable();
            $table->integer('case_id_fk')->nullable();
            $table->integer('client_id_fk')->nullable();
            $table->integer('pay_method_fk')->nullable();
            $table->integer('emp_id')->nullable();
            $table->string('emp_name')->nullable();
            $table->string('person_name')->nullable();
            $table->string('person_phone')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_case_payments');
    }
};
