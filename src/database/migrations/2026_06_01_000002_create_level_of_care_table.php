<?php

// database/migrations/2025_06_01_000002_create_level_of_care_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('level_of_care', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // ICU, HDU, General
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('level_of_care');
    }
};
