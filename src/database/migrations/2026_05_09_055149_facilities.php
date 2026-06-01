<?php

// database/migrations/2025_06_01_000001_create_facilities_table.php
// Adjust timestamp to be after your organizations table migration

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')
                  ->constrained('organizations')
                  ->onDelete('cascade');
            $table->string('code')->unique()->nullable();
            $table->string('name');
            $table->string('type')->nullable(); // hospital, clinic, pharmacy, lab, etc.
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('license_number')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('timezone')->default('UTC');
            $table->timestamps();
            $table->softDeletes();

            // Indexes for common query patterns
            $table->index(['organization_id', 'status']);
            $table->index('code');
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facilities');
    }
};
