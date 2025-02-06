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
        Schema::create('leadership_dues_reports', function (Blueprint $table) {
            $table->id();
            $table->string('leader_name');
            $table->string('category');
            $table->string('role');
            $table->string('membership_status');
            $table->dateTime('renewal_date');
            $table->dateTime('start_date');
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
        Schema::dropIfExists('leadership_dues_reports');
    }
};
