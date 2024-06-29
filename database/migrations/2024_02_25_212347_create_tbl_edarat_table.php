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
        Schema::create('tbl_edarat', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('from_id');
            $table->string('color');
            $table->timestamps();
            $table->index(['from_id', 'title']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_edarat');
    }
};
