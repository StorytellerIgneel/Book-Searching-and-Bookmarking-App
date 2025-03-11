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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(\App\Models\Author::class);
            $table->foreignIdFor(\App\Models\Category::class);
            $table->string('title');
            $table->year('year_published');
            $table->string('isbn')->unique()->nullable(); 
            $table->text('summary')->nullable(); 
            $table->string('cover_image_path')->nullable(); 
            $table->boolean('featured')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
