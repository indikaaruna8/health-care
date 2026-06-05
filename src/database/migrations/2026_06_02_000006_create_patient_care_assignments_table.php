<?php

// database/migrations/2025_06_01_000006_create_patient_care_assignments_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('patient_care_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admission_id')
                  ->constrained('admissions')
                  ->onDelete('cascade');
            $table->foreignId('level_of_care_id')
                  ->constrained('level_of_care')
                  ->onDelete('restrict');
            $table->foreignId('ward_id')
                  ->constrained('wards')
                  ->onDelete('restrict');
            $table->foreignId('bed_id')
                  ->constrained('beds')
                  ->onDelete('restrict');
            $table->timestamp('start_datetime');
            $table->timestamp('end_datetime')->nullable();
            $table->timestamps();

            $table->index(['admission_id', 'start_datetime']);
            $table->index(['ward_id', 'bed_id']);
            $table->index('end_datetime');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_care_assignments');
    }
};
