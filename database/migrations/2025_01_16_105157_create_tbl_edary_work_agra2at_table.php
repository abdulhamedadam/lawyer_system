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
        Schema::create('tbl_edary_work_agra2at', function (Blueprint $table) {
            $table->id();
            $table->integer('edary_work_id')->nullable();
            $table->integer('agra2_num')->nullable();
            $table->integer('year')->nullable();
            $table->date('agra2_date')->nullable();
            $table->string('agra2_take_place')->nullable();
            $table->integer('lawyer_id')->nullable();
            $table->text('alagra2')->nullable();
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
        Schema::dropIfExists('tbl_edary_work_agra2at');
    }
};
