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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('user_type')->nullable()->default(0);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();

            $table->string('company_name')->nullable();
            $table->bigInteger('company_inn')->nullable();
            $table->string('company_logo')->nullable()->default("/config/sample-company.png");

            $table->bigInteger('pinfl')->nullable();
            $table->string('passport_serial', 3)->nullable();
            $table->integer('passport_number')->unsigned()->nullable();
            $table->string('address')->nullable();
            $table->string('position', 60)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('avatar')->nullable()->default("/config/sample-user.png");
            $table->string('username')->nullable()->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('confirmed')->nullable()->default(true);
            $table->enum('status', ['inactive', 'active', 'blocked', 'deleted'])->nullable()->default('inactive');

            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
