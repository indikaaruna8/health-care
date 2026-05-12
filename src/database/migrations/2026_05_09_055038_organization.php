<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();

            // Core
            $table->string('name');
            $table->string('slug')->unique();

            // Business
            $table->string('type')->nullable(); // hospital, clinic, lab
            $table->string('registration_number')->nullable();
            $table->string('tax_id')->nullable();

            // Contact
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();

            // SaaS / Billing
            $table->string('plan')->default('free');
            $table->string('subscription_status')->default('trial');
            $table->timestamp('trial_ends_at')->nullable();

            // Branding
            $table->string('logo')->nullable();
            $table->string('timezone')->default('UTC');
            $table->string('locale')->default('en');

            // Ownership
            $table->foreignId('owner_id')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
