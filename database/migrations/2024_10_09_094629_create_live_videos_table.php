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
        Schema::create('live_videos', function (Blueprint $table) {
            $table->id();
            $table->integer('type_id')->unsigned()->nullable()->default(1);
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('archive_id')->nullable()->constrained('archive_years')->onUpdate('cascade')->onDelete('set null')->comment('InnoWeek Yili');
            $table->string('youtube_url', 100);
            $table->date('date')->nullable();
            $table->string('started_at', 10)->nullable();
            $table->string('title_uz')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_ru')->nullable();
            $table->enum('status', ['inactive', 'active', 'deleted'])->nullable()->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_videos');
    }
};
