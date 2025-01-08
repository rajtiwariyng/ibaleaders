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
        Schema::create('postreacts', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['like', 'dislike','heart','smile','smileheart'])->default('like');
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
            // $table->enum('referralstatus', ['card', 'call'])->default('card');
            // $table->string('address');
            // $table->string('telephone');
            // $table->string('email');
            // $table->text('comments');
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
        Schema::dropIfExists('postreact');
    }
};
