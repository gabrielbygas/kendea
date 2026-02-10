<?php
// Modified by Claude

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Aventures dans le Désert',
            'Attractions Aquatiques',
            'Visites Culturelles',
            'Sports Extrêmes',
            'Expériences de Luxe',
        ];

        foreach ($categories as $categoryName) {
            Category::create([
                'nom' => $categoryName,
                'slug' => Str::slug($categoryName),
            ]);
        }
    }
}
