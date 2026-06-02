<?php

// database/migrations/2025_06_01_000004_create_beds_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('beds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ward_id')
                  ->constrained('wards')
                  ->onDelete('cascade');
            $table->string('bed_number');
            $table->enum('status', ['available', 'occupied', 'maintenance', 'reserved'])->default('available');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['ward_id', 'bed_number']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beds');
    }
};
