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
        Schema::create('tbl_archive', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['clients','cases'])->nullable();
           // $table->string('type_name')->nullable();
            $table->integer('related_folder')->nullable();
            $table->integer('related_entity_id')->nullable();
            //$table->string('tasnef_id')->nullable();
            $table->integer('desk_id')->nullable();
            $table->integer('shelf_id')->nullable();
            $table->string('folder_code')->nullable();
            $table->enum('secret_degree',['high','low','medium'])->nullable();
            $table->string('year')->nullable();
            $table->string('month')->nullable();
            $table->integer('publisher_id')->nullable();
            $table->string('publisher_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_archive');
    }
};
