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
        Schema::create('tbl_tawkelat', function (Blueprint $table) {
            $table->id();
            $table->string('tawkel_type')->nullable();
            $table->integer('client_id')->nullable();
            $table->string('client_name')->nullable();
            $table->string('client_address')->nullable();
            $table->string('tawkel_number')->nullable();
            $table->string('client_phone')->nullable();
            $table->string('client_email')->nullable();
            $table->string('tawkel_authority')->nullable();
            $table->text('notes')->nullable();
            $table->string('tawkel_image')->nullable();
            $table->string('tawkel_date')->nullable();
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
        Schema::dropIfExists('tbl_tawkelat');
    }
};
