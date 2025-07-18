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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict')->comment('Taxrirlayotgan foydalanuvchi');
            $table->foreignId('archive_id')->nullable()->constrained('archive_years')->onUpdate('cascade')->onDelete('set null')->comment('InnoWeek Yili');
            $table->date('date')->nullable();
            $table->string('started_at', 10)->nullable();
            $table->string('stopped_at', 10)->nullable();
            $table->string('title_uz')->nullable();
            $table->string('title_ru')->nullable();
            $table->string('title_en')->nullable();
            $table->string('live_url')->nullable();
            $table->string('innoweek_video')->nullable();
            $table->mediumText('description_uz')->nullable();
            $table->mediumText('description_ru')->nullable();
            $table->mediumText('description_en')->nullable();
            $table->string('address_uz')->nullable();
            $table->string('address_ru')->nullable();
            $table->string('address_en')->nullable();
            $table->enum('status', ['inactive', 'active', 'deleted'])->nullable()->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
