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
        Schema::create('hr_general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->Enum('ttype',['mokalfat','edarat','holidays'])->nullable();
            $table->integer('from_id')->nullable();
            $table->text('details')->nullable();
            $table->string('color')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hr_general_settings');
    }
};
