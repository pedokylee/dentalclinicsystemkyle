<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            // Patient (always required)
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete();

            // Dentist (nullable, assigned later by admin)
            $table->foreignId('dentist_id')->nullable()->constrained()->nullOnDelete();

            // Service (nullable, chosen later by admin)
            $table->foreignId('service_id')->nullable()->constrained()->nullOnDelete();

            // Facility (optional)
            $table->foreignId('facility_id')->nullable()->constrained()->nullOnDelete();

            // Date & Time
            $table->timestamp('appointment_date');

            // Status (default: scheduled)
            $table->enum('status', ['scheduled', 'completed', 'cancelled'])->default('scheduled');

            // Notes / Concerns
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
