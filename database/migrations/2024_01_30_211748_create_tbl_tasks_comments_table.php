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
        Schema::create('tbl_tasks_comments', function (Blueprint $table) {
            $table->id();
            $table->integer('task_id_fk')->nullable();
            $table->string('comment',700)->nullable();
            $table->integer('from_user_id')->nullable();
            $table->integer('to_user_id')->nullable();
            $table->tinyInteger('to_user_seen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_tasks_comments');
    }
};
