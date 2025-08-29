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
        Schema::create('eco_ideathons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('region_id')->constrained('regions')->onDelete('cascade');
            $table->string('full_name');
            $table->integer('age');
            $table->string('phone', 20);
            $table->string('email', 100);
            $table->text('project_name');
            $table->text('project_brief');
            $table->text('project_goal');
            $table->text('project_problem');
            $table->text('implementation_plan');
            $table->text('team_info');
            $table->text('why_chosen');
            $table->string('presentation');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eco_ideathons');
    }
};
