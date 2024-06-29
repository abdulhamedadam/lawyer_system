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
        Schema::create('tbl_tasks_files', function (Blueprint $table) {
            $table->id();
            $table->integer('task_id_fk')->nullable();
            $table->string('file_name')->nullable();
            $table->string('file')->nullable();
            $table->enum('ttype_result',['yes','no'])->default('no')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_tasks_files');
    }
};
