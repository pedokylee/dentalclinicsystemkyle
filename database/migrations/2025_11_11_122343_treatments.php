<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();

            // Link to appointment
            $table->foreignId('appointment_id')->constrained()->onDelete('cascade');

            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->foreignId('dentist_id')->constrained()->onDelete('cascade');
            
            $table->string('procedure');
            $table->decimal('cost', 10, 2)->default(0);
            $table->enum('status', ['completed', 'in-progress', 'scheduled', 'cancelled'])->default('scheduled');
            $table->text('notes')->nullable();
            $table->date('date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('treatments');
    }
};
