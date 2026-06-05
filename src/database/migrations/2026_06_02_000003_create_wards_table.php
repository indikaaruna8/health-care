<?php

// database/migrations/2025_06_01_000003_create_wards_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('wards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('facility_id')
                  ->constrained('facilities')
                  ->onDelete('cascade');
            $table->string('name');
            $table->string('type')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['facility_id', 'name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wards');
    }
};
