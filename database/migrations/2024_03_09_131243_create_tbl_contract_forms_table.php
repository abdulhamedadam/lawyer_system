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
        Schema::create('tbl_contract_forms', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('contract_name')->nullable();
            $table->text('contract_body')->nullable();
            $table->integer('publisher_id')->nullable();
            $table->string('publisher_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_contract_forms');
    }
};
