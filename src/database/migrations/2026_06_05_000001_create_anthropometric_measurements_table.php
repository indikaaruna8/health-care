<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anthropometric_measurements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admission_id')
                ->constrained('admissions')
                ->onDelete('cascade');
            $table->decimal('weight_kg', 5, 2);
            $table->decimal('height_cm', 5, 2);
            $table->decimal('bmi', 5, 2)->nullable();
            $table->timestamp('measured_at');
            $table->timestamps();

            $table->index('admission_id');
            $table->index('measured_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anthropometric_measurements');
    }
};
