<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('encounters', function (Blueprint $table) {
            $table->id();

            $table->foreignId('admission_id')->constrained()->cascadeOnDelete();
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete();

            // Human readable reference (e.g. ENC-2026-000123)
            $table->string('encounter_number')->unique();

            // Optional barcode value (can be same as encounter_number or encoded)
            $table->string('encounter_barcode')->nullable()->unique();

            $table->timestamp('started_at');
            $table->timestamp('ended_at')->nullable();

            // Clinical classification
            $table->string('type');
            // e.g. emergency, nursing_assessment, ward_round, opd

            $table->string('status')->default('active');
            // active, completed, cancelled

            $table->text('chief_complaint')->nullable();

            $table->foreignId('recorded_by')->constrained('users');

            $table->timestamps();
            $table->softDeletes();

            $table->index(['admission_id', 'patient_id']);
            $table->index('encounter_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('encounters');
    }
};
