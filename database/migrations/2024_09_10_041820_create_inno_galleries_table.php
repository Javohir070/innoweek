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
        Schema::create('inno_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null')->comment('Taxrirlayotgan foydalanuvchi');
            $table->integer('archive_id')->unsigned()->nullable()->default(1);
            $table->string('image')->nullable();
            $table->string('youtube_url')->nullable();
            $table->enum('status', ['inactive', 'active', 'deleted'])->nullable()->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inno_galleries');
    }
};
