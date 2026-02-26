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
        // Parse CSV and extract unique categories
        $csvFile = database_path('../docs/kendea_activity_list.csv');
        
        if (!file_exists($csvFile)) {
            $this->command->error('CSV file not found: ' . $csvFile);
            return;
        }

        $handle = fopen($csvFile, 'r');
        
        // Skip first empty line
        fgetcsv($handle);
        
        // Read headerpu
        fgetcsv($handle);
        
        $categoryMapping = [];
        
        while (($row = fgetcsv($handle)) !== false) {
            // Skip empty rows
            if (empty($row[5])) {
                continue;
            }
            
            $categorySlug = $row[5];
            
            // Build category mapping from CSV data
            if (!isset($categoryMapping[$categorySlug])) {
                $categoryMapping[$categorySlug] = true;
            }
        }
        
        fclose($handle);
        
        // Define proper French and English names for each category
        $categoryNames = [
            'attraction' => ['nom' => 'Attractions', 'nom_en' => 'Attractions'],
            'adventure' => ['nom' => 'Aventure', 'nom_en' => 'Adventure'],
            'desert-adventure' => ['nom' => 'Aventure Désert', 'nom_en' => 'Desert Adventure'],
            'waterpark' => ['nom' => 'Parcs Aquatiques', 'nom_en' => 'Water Parks'],
            'aquarium' => ['nom' => 'Aquariums', 'nom_en' => 'Aquariums'],
            'theme-park' => ['nom' => 'Parcs à Thème', 'nom_en' => 'Theme Parks'],
            'wildlife-park' => ['nom' => 'Parcs Animaliers', 'nom_en' => 'Wildlife Parks'],
            'zoo' => ['nom' => 'Zoos', 'nom_en' => 'Zoos'],
            'show' => ['nom' => 'Spectacles', 'nom_en' => 'Shows'],
            'cruise' => ['nom' => 'Croisières', 'nom_en' => 'Cruises'],
            'nature-park' => ['nom' => 'Parcs Naturels', 'nom_en' => 'Nature Parks'],
            'immersive-experience' => ['nom' => 'Expériences Immersives', 'nom_en' => 'Immersive Experiences'],
        ];
        
        // Create categories that exist in CSV
        foreach (array_keys($categoryMapping) as $slug) {
            if (isset($categoryNames[$slug])) {
                Category::create([
                    'nom' => $categoryNames[$slug]['nom'],
                    'nom_en' => $categoryNames[$slug]['nom_en'],
                    'slug' => Str::slug($categoryNames[$slug]['nom']),
                ]);
            }
        }
    }
}