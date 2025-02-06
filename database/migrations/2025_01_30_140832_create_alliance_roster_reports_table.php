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
        Schema::create('alliance_roster_reports', function (Blueprint $table) {
            $table->id();
            $table->string('leader_name');
            $table->string('category');
            $table->string('company_name');
            $table->string('lvp_score');
            $table->string('rg');
            $table->string('rr');
            $table->string('v');
            $table->string('gbr');
            $table->string('bg');
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
        Schema::dropIfExists('alliance_roster_reports');
    }
};
