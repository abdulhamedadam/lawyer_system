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
        Schema::create('tbl_assets', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('assets_type')->nullable();
            $table->text('notes')->nullable();
            $table->integer('received_by')->nullable();
            $table->integer('supplier')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->decimal('purchase_value', 15, 2)->nullable();
            $table->string('purchase_date', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_assets');
    }
};
