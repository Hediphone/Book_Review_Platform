<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
     /**
      * Run the migrations.
      */
     public function up(): void
     {
          if (!Schema::hasTable('reviews')) {
               Schema::create('reviews', function (Blueprint $table) {
                    $table->id();
                    $table->unsignedBigInteger('user_id');
                    $table->unsignedBigInteger('bookID');
                    $table->decimal('rating', 3, 2)->nullable();
                    $table->string('comment', 255)->nullable();
                    $table->timestamps();
                
                    $table->foreign('bookID')->references('bookID')->on('books')->onDelete('cascade');
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                });
                
          }
     }

     /**
      * Reverse the migrations.
      */
     public function down(): void
     {
          Schema::dropIfExists('reviews');
     }
};
