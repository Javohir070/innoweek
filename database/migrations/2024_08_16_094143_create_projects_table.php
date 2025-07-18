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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->integer('publish_year')->unsigned()->nullable()->default(2024);
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict')->comment('Taxrirlayotgan foydalanuvchi');
            $table->foreignId('author_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict')->comment('Loyiha egasi');

            $table->string('project_title');
            $table->foreignId('type_id')->nullable()->constrained('project_types')->onUpdate('cascade')->onDelete('restrict')->comment('Loyiha turi');
            $table->foreignId('category_id')->nullable()->constrained('project_categories')->onUpdate('cascade')->onDelete('restrict')->comment('Loyiha kategoriyasi');
            $table->integer('creation_year')->unsigned()->nullable();
            $table->string('amount')->nullable();
            $table->foreignId('country_id')->nullable()->constrained('countries')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('region_id')->nullable()->constrained('regions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('district_id')->nullable()->constrained('districts')->onDelete('cascade')->onUpdate('cascade');
            $table->longText('description')->nullable();
            $table->string('video_url')->nullable();
            $table->string('certificate_number')->nullable();
            $table->string('certificate_url')->nullable();
            $table->string('trademark')->nullable();
            $table->bigInteger('unit_type_id')->nullable();
            $table->integer('min_order_value')->unsigned()->nullable();
            $table->integer('max_order_value')->unsigned()->nullable();
            $table->float('amount_per')->nullable()->default(0.00);
            $table->float('amount_total')->nullable()->default(0.00);
            $table->date('expiration_date')->nullable();
            $table->integer('delivery_date')->unsigned()->nullable();
            $table->bigInteger('delivery_type_id')->nullable();
            $table->integer('warranty_period')->unsigned()->nullable();
            $table->bigInteger('wp_type_id')->nullable();
            $table->mediumText('warranty_policy')->nullable();
            $table->string('passport_file')->nullable();
            $table->string('locality_file')->nullable();
            $table->string('innovation_file')->nullable();
            $table->enum('status', ['waiting', 'editing', 'approved', 'canceled', 'deleted'])->nullable()->default('waiting');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
