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
        Schema::create('individuals', function (Blueprint $table) {
            $table->id();
            $table->string('individualname');
            $table->string('individualbusiness');
            $table->string('individualachievement');
            $table->string('individualreferrals');
            $table->string('individualreferralsqty');
            $table->string('individualreferralsmrs');
            $table->string('individualreferralsmrsqty');
            $table->string('individualdirect');
            $table->string('individualdirectmrs');
            $table->string('individualbusinesstotal');
            $table->string('individualgbrmrs');
            $table->string('individualgbramount');
            $table->string('individualvisitors');
            $table->string('individualtestimonialmrs');
            $table->string('individualgivetoday');
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
        Schema::dropIfExists('individuals');
    }
};
