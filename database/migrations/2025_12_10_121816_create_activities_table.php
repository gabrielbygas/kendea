<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Modified by Claude
     */
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('slug')->unique();
            $table->text('description');
            $table->decimal('prix', 10, 2);
            $table->string('location');
            $table->foreignId('categorie_id')->constrained('categories')->onDelete('cascade');
            $table->json('images'); // Store array of up to 5 image paths
            $table->decimal('notes', 2, 1)->default(4.5); // 0.0 to 5.0
            $table->timestamps();

            // Indexes for performance and filtering
            $table->index('slug');
            $table->index('prix');
            $table->index('notes');
            $table->index('categorie_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
