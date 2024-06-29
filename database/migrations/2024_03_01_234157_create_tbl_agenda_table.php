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
        Schema::create('tbl_agenda', function (Blueprint $table) {
            $table->id();
            $table->enum('category',['session','task','other'])->nullable();
            $table->integer('related_id')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->enum('status',['do','doing','done','delayed','canceled'])->nullable();
            $table->decimal('evaluted_degree')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_agenda');
    }
};
