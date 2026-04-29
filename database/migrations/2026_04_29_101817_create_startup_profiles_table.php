<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('startup_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->string('startup_name');
            $table->string('industry');
            $table->enum('stage', ['idea', 'mvp', 'growth']);
            $table->text('problem');
            $table->text('help_needed');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('startup_profiles');
    }
};
