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
        Schema::create('tyfcbreferrals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('received_to')->constrained('users')->onDelete('cascade');
            $table->string('amount');
            $table->enum('businesstype', ['new', 'repeat'])->default('new');
            $table->enum('type', ['inside', 'outside','other'])->default('inside');
            $table->text('comments');
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
        Schema::dropIfExists('tyfcbreferrals');
    }
};
