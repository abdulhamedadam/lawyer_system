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
        Schema::create('tbl_clients', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('nationality_id');
            $table->bigInteger('national_id')->nullable();
            $table->date('date_of_birth_st')->nullable();
            $table->date('date_of_birth_ar')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('current_address')->nullable();
            $table->string('phone_number', 15)->nullable();
            $table->string('whats_number', 15)->nullable();
            $table->string('gender', 11)->nullable();
            $table->string('work_place', 100)->nullable();
            $table->string('personal_image')->nullable();
            $table->unsignedBigInteger('governate_id')->nullable();
            $table->unsignedBigInteger('religion')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('region_id')->nullable();
            $table->enum('status', ['inactive', 'active'])->default('active');
            $table->unsignedBigInteger('marital_status')->nullable();
            $table->unsignedBigInteger('job_title')->nullable();
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
        Schema::dropIfExists('tbl_clients');
    }
};
