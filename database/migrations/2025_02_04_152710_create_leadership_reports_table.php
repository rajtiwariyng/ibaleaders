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
        Schema::create('leadership_reports', function (Blueprint $table) {
            $table->id();
            $table->string('leader_name');
            $table->string('p');
            $table->string('a');
            $table->string('l');
            $table->string('m');
            $table->string('s');
            $table->string('rg');
            $table->string('rr');
            $table->string('bg');
            $table->string('gbr');
            $table->string('v');
            $table->string('dm');
            $table->string('events');
            $table->string('t');
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
        Schema::dropIfExists('leadership_reports');
    }
};
