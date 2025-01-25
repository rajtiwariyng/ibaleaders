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
        Schema::create('privacysettings', function (Blueprint $table) {
            $table->id();
            $table->enum('phoneshow', ['1', '0'])->default('1');
            $table->enum('emailshow', ['1', '0'])->default('1');
            $table->enum('addtestimonial', ['1', '0'])->default('1');
            $table->enum('postshow', ['1', '0'])->default('1');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->softDeletes();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('privacysettings');
    }
};
