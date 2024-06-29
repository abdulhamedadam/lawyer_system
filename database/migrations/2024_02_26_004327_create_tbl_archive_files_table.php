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
        Schema::create('tbl_archive_files', function (Blueprint $table) {
            $table->id();
            $table->integer('archive_id');
            $table->integer('folder_code');
            $table->string('file_name');
            $table->string('file');
           // $table->text('prevent_from');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_archive_files');
    }
};
