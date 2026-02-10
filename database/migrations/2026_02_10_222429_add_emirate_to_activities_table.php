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
        Schema::table('activities', function (Blueprint $table) {
            $table->enum('emirate', [
                'Abu Dhabi',
                'Ajman',
                'Dubai',
                'Fujairah',
                'Ras Al Khaimah',
                'Sharjah',
                'Umm Al Quwain'
            ])->default('Dubai')->after('location');
            $table->index('emirate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropIndex(['emirate']);
            $table->dropColumn('emirate');
        });
    }
};
