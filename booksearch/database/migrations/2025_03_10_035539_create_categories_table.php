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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->unique();
            $table->text('description')->nullable();
        });

        // Pivot table for Many-to-Many relationship (Book - Categories)
        // Schema::create('book_category', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignIdFor(\App\Models\Book::class)->constrained()->onDelete('cascade');
        //     $table->foreignIdFor(\App\Models\Category::class)->constrained()->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
