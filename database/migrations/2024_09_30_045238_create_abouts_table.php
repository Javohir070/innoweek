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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict')->comment('Taxrirlayotgan foydalanuvchi');
            $table->foreignId('author_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null')->comment('Loyiha egasi');

            $table->string('image')->nullable()->default("/config/sample-abouts.png");
            $table->string('project')->nullable()->default("/config/sample-abouts.png");
            $table->string('brashura')->nullable()->default("/config/sample-abouts.png");

            $table->longText('description_uz')->nullable();
            $table->longText('description_en')->nullable();
            $table->longText('description_ru')->nullable();
            $table->enum('status', ['inactive', 'active', 'deleted'])->nullable()->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
