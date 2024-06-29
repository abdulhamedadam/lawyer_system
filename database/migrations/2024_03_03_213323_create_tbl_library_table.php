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
        Schema::create('tbl_library', function (Blueprint $table) {
            $table->id();
            $table->integer('fe2a')->nullable();
            $table->string('book_name')->nullable();
            $table->string('book')->nullable();
            $table->string('description')->nullable();
            $table->integer('author')->nullable();
            $table->integer('read_number')->nullable();
            $table->integer('taqeem_number')->nullable();
            $table->integer('publisher_id')->nullable();
            $table->string('publisher_name')->nullable();
            $table->timestamps();
            $table->index('fe2a');
            $table->index('author');
            $table->index('book_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_library');
    }
};
