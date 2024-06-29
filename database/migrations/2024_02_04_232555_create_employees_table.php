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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee',250)->nullable();
            $table->string('emp_code',100)->nullable();
            $table->bigInteger('card_num')->nullable();
            $table->integer('gender')->nullable();
            $table->integer('governate_id_fk')->nullable();
            $table->integer('city_id_fk')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('personal_photo')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('address')->nullable();
            $table->integer('nationality')->nullable();
            $table->integer('material_status')->nullable();
            $table->integer('deyana')->nullable();
            $table->integer('employee_degree')->nullable();
            $table->integer('employee_qualification')->nullable();
            $table->tinyInteger('employee_type')->nullable()->default(1);
            $table->integer('manager')->nullable();
            $table->string('start_work_date')->nullable();
            $table->string('end_contract_date')->nullable();
            $table->string('end_service_date')->nullable();
            $table->integer('edara_id')->nullable();
            $table->string('edara_n')->nullable();
            $table->integer('qsm_id')->nullable();
            $table->string('qsm_n')->nullable();
            $table->integer('mosma_wazefy_code')->nullable();
            $table->string('mosma_wazefy_n')->nullable();
            $table->string('test_num_month')->nullable();
            $table->string('end_test_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
