<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('startup_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('mentor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('slot_id')->constrained('time_slots')->onDelete('cascade');
            $table->enum('status', ['scheduled', 'completed', 'cancelled']);
            $table->timestamps();

            $table->index('startup_id');
            $table->index('mentor_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
