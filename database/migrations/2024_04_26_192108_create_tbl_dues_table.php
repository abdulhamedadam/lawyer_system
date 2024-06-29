<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{



    public function up(): void
    {
        Schema::create('tbl_dues', function (Blueprint $table) {
            $table->id();
            $table->string('value')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('date')->nullable();
            $table->enum('type',['case','legal_service','other'])->nullable();
            $table->integer('type_related_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->timestamps();
        });
    }




    public function down(): void
    {
        Schema::dropIfExists('tbl_dues');
    }



};
