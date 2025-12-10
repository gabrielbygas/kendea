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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->json('activities'); // Array of activity IDs
            $table->dateTime('datetime');
            $table->decimal('montant_total', 10, 2);
            $table->string('statut')->default('en_attente'); // en_attente, confirme, annule
            $table->timestamps();

            // Indexes
            $table->index('client_id');
            $table->index('datetime');
            $table->index('statut');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
