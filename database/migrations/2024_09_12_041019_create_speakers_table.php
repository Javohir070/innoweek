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
        Schema::create('speakers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict')->comment('Taxrirlayotgan foydalanuvchi');
            $table->foreignId('archive_id')->nullable()->constrained('archive_years')->onUpdate('cascade')->onDelete('set null')->comment('InnoWeek Yili');
            $table->string('full_name_uz');
            $table->string('full_name_ru')->nullable();
            $table->string('full_name_en')->nullable();
            $table->string('job_uz')->nullable();
            $table->string('job_ru')->nullable();
            $table->string('job_en')->nullable();
            $table->string('image')->nullable()->default("/config/sample-speaker.png");
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->longText('description_en')->nullable();
            $table->longText('description_ru')->nullable();
            $table->longText('description_uz')->nullable();
            $table->enum('status', ['inactive', 'active', 'deleted'])->nullable()->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speakers');
    }
};
