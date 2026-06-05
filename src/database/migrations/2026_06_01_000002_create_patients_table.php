<?php

// database/migrations/2025_06_01_000001_create_patients_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('nhi_number')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('preferred_name')->nullable();
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female', 'other', 'unknown']);
            $table->string('ethnicity')->nullable();
            $table->text('address')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('preferred_language')->nullable();
            $table->boolean('interpreter_required')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['last_name', 'first_name']);
            $table->fullText(['first_name', 'last_name', 'preferred_name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
