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
        Schema::create('tbl_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('ensha_date',15)->nullable();
            $table->string('task_name',255)->nullable();
            $table->integer('case_id_fk')->nullable();
            $table->integer('priority_id_fk')->nullable();
            $table->integer('esnad_to')->nullable();
            $table->string('start_date',15)->nullable();
            $table->string('end_date',15)->nullable();
            $table->integer('publisher')->nullable();
            $table->string('publisher_name')->nullable();
            $table->integer('from_user_id')->nullable();
            $table->integer('to_user_id')->nullable();
            $table->integer('from_agent_id')->nullable();
            $table->integer('to_agent_id')->nullable();
            $table->text('task_details')->nullable();
            $table->string('created')->nullable();
            $table->string('updated')->nullable();
            $table->enum('action_ended',['do','doing','done'])->nullable()->default('do');
            $table->enum('estlam',['no','yes'])->nullable()->default('no');
            $table->integer('num_days')->nullable();
            $table->text('action_ended_reason')->nullable();
            $table->text('action_ended_result')->nullable();
            $table->integer('action_ended_emp_id')->nullable();
            $table->string('action_ended_date',15)->nullable();
            $table->string('action_ended_time',10)->nullable();
            $table->string('action_estlam_date',15)->nullable();
            $table->string('action_estlam_time',10)->nullable();
            $table->string('action_estlam_notes')->nullable();
            $table->string('deadline_date',15)->nullable();
            $table->string('deadline_time',10)->nullable();
            $table->tinyInteger('seen')->nullable()->default(0);
            $table->string('from_date')->nullable();
            $table->string('to_date',15)->nullable();
            $table->enum('end_takeem',['no','yes'])->nullable()->default('no');
            $table->enum('amal_elazem',['no','yes'])->nullable()->default('no');
            $table->integer('takeem_wakt')->nullable();
            $table->decimal('takeem_gwda')->nullable();
            $table->integer('takeem_t3won')->nullable();
            $table->string('takeem_date',15)->nullable();
            $table->string('takeem_time',10)->nullable();
            $table->integer('takeem_user')->nullable();
            $table->string('takeem_reason')->nullable();
            $table->decimal('takeem_time_work')->nullable()->default(0.00);
            $table->decimal('takeem_tahsin')->nullable()->default(0.00);
            $table->integer('current_to_user_id')->nullable();
            $table->tinyInteger('comment_seen')->nullable()->default(0);
            $table->string('last_mad_date')->nullable();
            $table->string('last_mad_time')->nullable();
            $table->integer('last_mad_user')->nullable();
            $table->string('last_mad_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_tasks');
    }
};
