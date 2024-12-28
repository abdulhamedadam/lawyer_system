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
        Schema::create('tbl_cash_transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('transaction_type', ['deposit', 'withdrawal', 'transfer'])->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->integer('source_box_id')->nullable();
            $table->integer('destination_box_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->text('reasons')->nullable();
            $table->string('date')->nullable();
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
        Schema::dropIfExists('tbl_cash_transactions');
    }
};
