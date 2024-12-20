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
                    $table->id('reviewID');
                    $table->unsignedBigInteger('userID');
                    $table->unsignedBigInteger('bookID');
                    $table->integer('rating')->nullable();
                    $table->string('comment', 255)->nullable();
                    $table->timestamps();
                
                    $table->foreign('bookID')->references('bookID')->on('books')->onDelete('cascade');
                    $table->foreign('userID')->references('id')->on('users')->onDelete('cascade');
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
