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
            ['nom' => 'Monuments Emblématiques et Architecture Moderne', 'nom_en' => 'Iconic Landmarks & Modern Architecture'],
            ['nom' => 'Aventures dans le Désert', 'nom_en' => 'Desert Adventures'],
            ['nom' => 'Parcs à Thèmes et Attractions Familiales', 'nom_en' => 'Theme Parks & Family Attractions'],
            ['nom' => 'Nature et Sports d\'Aventure', 'nom_en' => 'Nature & Adventure Sports'],
            ['nom' => 'Culture et Exploration Historique', 'nom_en' => 'Culture & Historical Exploration'],
            ['nom' => 'Gastronomie, Shopping et Vie Nocturne', 'nom_en' => 'Dining, Shopping & Nightlife'],
            ['nom' => 'Croisières et Activités Nautiques', 'nom_en' => 'Cruises & Water Activities'],
            ['nom' => 'Festivals, Événements et Activités Saisonnières', 'nom_en' => 'Festivals, Events & Seasonal Activities'],
            ['nom' => 'Expériences de Luxe et Bien-être', 'nom_en' => 'Luxury Experiences & Wellness'],
            ['nom' => 'Sports Extrêmes et Sensations Fortes', 'nom_en' => 'Extreme Sports & Thrills'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'nom' => $category['nom'],
                'nom_en' => $category['nom_en'],
                'slug' => Str::slug($category['nom']),
            ]);
        }
    }
}
