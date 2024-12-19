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
        Schema::create('replies', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('review_id'); // This will reference the review being replied to
            $table->unsignedBigInteger('user_id'); // The user who is replying
            $table->text('comment'); // The reply content
            $table->timestamps(); // Timestamps for created_at and updated_at

            // Define the foreign key constraints
            $table->foreign('review_id')->references('reviewID')->on('reviews')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replies');
    }
};
