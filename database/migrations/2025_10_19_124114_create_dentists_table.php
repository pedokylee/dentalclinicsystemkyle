<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dentists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('specialization')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('license_number')->nullable();
            $table->integer('years_of_experience')->nullable();
            $table->text('bio')->nullable();
            $table->json('availability')->nullable();
            $table->enum('status', ['active', 'on-leave', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dentists');
    }
};
