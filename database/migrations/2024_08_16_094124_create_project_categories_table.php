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
        Schema::create('project_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict')->comment('Taxrirlayotgan foydalanuvchi');
            $table->string('name_uz');
            $table->string('name_en')->nullable();
            $table->string('name_ru')->nullable();
            $table->enum('status', ['inactive', 'activated', 'deleted'])->nullable()->default('activated');
            $table->timestamps();
        });

        Schema::table('project_categories', function (Blueprint $table) {
            $table->foreignId('parent_id')->nullable()->constrained('project_categories')->onUpdate('cascade')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_categories');
    }
};
