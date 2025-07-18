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
        Schema::create('user_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('archive_id')->nullable()->constrained('archive_years')->onUpdate('cascade')->onDelete('set null')->comment('InnoWeek Yili');
            $table->foreignId('ticket_id')->nullable()->constrained('user_tickets')->onUpdate('cascade')->onDelete('cascade')->comment('Ticket');
            $table->enum('status', ['inactive', 'approve', 'deleted'])->nullable()->default('approve');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_visits');
    }
};
