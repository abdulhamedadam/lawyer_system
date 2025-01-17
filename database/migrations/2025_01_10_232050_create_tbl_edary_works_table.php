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
        Schema::create('tbl_edary_works', function (Blueprint $table) {
            $table->id();
            $table->date('estlam_date')->nullable();
            $table->date('date_authority')->nullable();
            $table->integer('client_id');
            $table->integer('tawkel_id');
            $table->string('edary_work_type');
            $table->integer('esnad_to_id')->nullable();
            $table->text('subject_entity')->nullable();
            $table->string('authority_entity')->nullable();
            $table->text('subject_entity_address')->nullable();
            $table->decimal('total_fees', 10, 2)->nullable();
            $table->text('subject')->nullable();
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
        Schema::dropIfExists('tbl_edary_works');
    }
};
