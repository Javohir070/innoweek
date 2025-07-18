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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict')->comment('Taxrirlayotgan foydalanuvchi');
            $table->foreignId('author_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null')->comment('Loyiha egasi');
            $table->foreignId('category_id')->nullable()->constrained('news_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->string('image')->nullable()->default("/config/sample-news.png");
            $table->string('title_uz');
            $table->longText('description_uz');
            $table->string('title_en')->nullable();
            $table->longText('description_en')->nullable();
            $table->string('title_ru')->nullable();
            $table->longText('description_ru')->nullable();
            $table->longText('keywords')->nullable();
            $table->enum('status', ['inactive', 'active', 'deleted'])->nullable()->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
