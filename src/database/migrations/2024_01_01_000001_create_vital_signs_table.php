<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vital_signs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('admission_id')->constrained('admissions')->onDelete('cascade');
            $table->foreignId('encounter_id')->nullable()->constrained('encounters')->onDelete('set null');
            $table->foreignId('recorded_by')->constrained('users')->onDelete('cascade');

            $table->timestamp('observation_at');

            $table->integer('respiratory_rate')->nullable();
            $table->decimal('spo2', 5, 2)->nullable();

            $table->integer('systolic_bp')->nullable();
            $table->integer('diastolic_bp')->nullable();

            $table->integer('heart_rate')->nullable();
            $table->decimal('temperature', 5, 2)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('admission_id');
            $table->index('encounter_id');
            $table->index('observation_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vital_signs');
    }
};
