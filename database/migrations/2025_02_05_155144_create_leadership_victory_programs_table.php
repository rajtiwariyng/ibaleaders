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
        Schema::create('leadership_victory_programs', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('category');
            $table->string('avg_referrals');
            $table->string('avg_visitors');
            $table->string('business_given');
            $table->string('absenteeism');
            $table->string('events_attended');
            $table->string('testimonial');
            $table->string('late');
            $table->string('lvp_score');
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
        Schema::dropIfExists('leadership_victory_programs');
    }
};
