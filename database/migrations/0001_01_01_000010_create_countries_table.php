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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict')->comment('Taxrirlayotgan foydalanuvchi');
            $table->string('name_uz');
            $table->string('name_en')->nullable();
            $table->string('name_ru')->nullable();
            $table->string('state_code', 10)->nullable();
            $table->string('phone_code', 10)->nullable();
            $table->string('flag')->nullable();
            $table->enum('status', ['inactive', 'activated', 'deleted'])->nullable()->default('activated');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
