<?php
// Modified by Claude

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Activity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds - Import from kendea_activity_list.csv with real locations
     */
    public function run(): void
    {
        // Real location mapping based on online research
        $locationMapping = [
            'la-perle-by-dragone' => ['location' => 'Al Habtoor City, Sheikh Zayed Road', 'emirate' => 'Dubai'],
            'dubai-miracle-garden' => ['location' => 'Al Barsha South 3, Dubailand', 'emirate' => 'Dubai'],
            'global-village-dubai' => ['location' => 'Sheikh Mohammed Bin Zayed Road, Exit 37', 'emirate' => 'Dubai'],
            'aya-universe-dubai' => ['location' => 'WAFI City Mall, Oud Metha Road', 'emirate' => 'Dubai'],
            'dubai-frame' => ['location' => 'Zabeel Park, Gate 4', 'emirate' => 'Dubai'],
            'burj-khalifa-at-the-top' => ['location' => 'Downtown Dubai', 'emirate' => 'Dubai'],
            'ski-dubai' => ['location' => 'Mall of the Emirates, Al Barsha 1', 'emirate' => 'Dubai'],
            'atlantis-aquaventure-waterpark' => ['location' => 'Crescent Road, Palm Jumeirah', 'emirate' => 'Dubai'],
            'dubai-aquarium-underwater-zoo' => ['location' => 'The Dubai Mall, Downtown Dubai', 'emirate' => 'Dubai'],
            'img-worlds-of-adventure' => ['location' => 'City of Arabia, Dubailand', 'emirate' => 'Dubai'],
            'dubai-safari-park' => ['location' => 'Al Warqa 5', 'emirate' => 'Dubai'],
            'the-green-planet-dubai' => ['location' => 'City Walk, Al Wasl', 'emirate' => 'Dubai'],
            'deep-dive-dubai-scuba' => ['location' => 'NAS Sports Complex, Nad Al Sheba 1', 'emirate' => 'Dubai'],
            'dolphin-and-seal-show' => ['location' => 'Atlantis The Palm, Palm Jumeirah', 'emirate' => 'Dubai'],
            'lost-chambers-aquarium' => ['location' => 'Atlantis The Palm, Palm Jumeirah', 'emirate' => 'Dubai'],
            'xline-dubai-marina' => ['location' => 'Dubai Marina Mall, Sheikh Zayed Road', 'emirate' => 'Dubai'],
            'dubai-marina-yacht-cruise' => ['location' => 'Dubai Marina Yacht Club', 'emirate' => 'Dubai'],
            'desert-dune-bashing' => ['location' => 'Dubai Desert Conservation Reserve', 'emirate' => 'Dubai'],
            'camel-riding-desert' => ['location' => 'Al Marmoom Desert', 'emirate' => 'Dubai'],
            'hot-air-balloon-dubai' => ['location' => 'Margham Desert, Dubai-Al Ain Road', 'emirate' => 'Dubai'],
        ];

        // Parse CSV file
        $csvFile = database_path('../docs/kendea_activity_list.csv');
        
        if (!file_exists($csvFile)) {
            $this->command->error('CSV file not found: ' . $csvFile);
            return;
        }

        $handle = fopen($csvFile, 'r');
        
        // Skip first empty line
        fgetcsv($handle);
        
        // Read header
        fgetcsv($handle);
        
        while (($row = fgetcsv($handle)) !== false) {
            // Skip empty rows
            if (empty($row[1])) {
                continue;
            }

            $nomSlug = $row[1];
            $nomEn = $row[2] ?? '';
            $description = $row[3] ?? '';
            $descriptionEn = $row[4] ?? '';
            $categorySlug = $row[5] ?? '';
            $prixStr = $row[6] ?? '';

            // Parse price (format: "220-aed" -> 220)
            $prix = 0;
            if (preg_match('/(\d+)-aed/', $prixStr, $matches)) {
                $prix = (int)$matches[1];
            }

            // Get category
            $categoryNames = [
                'attraction' => 'Attractions',
                'adventure' => 'Aventure',
                'desert-adventure' => 'Aventure Désert',
                'waterpark' => 'Parcs Aquatiques',
                'aquarium' => 'Aquariums',
                'theme-park' => 'Parcs à Thème',
                'wildlife-park' => 'Parcs Animaliers',
                'zoo' => 'Zoos',
                'show' => 'Spectacles',
                'cruise' => 'Croisières',
                'nature-park' => 'Parcs Naturels',
                'immersive-experience' => 'Expériences Immersives',
            ];

            if (!isset($categoryNames[$categorySlug])) {
                continue;
            }

            $category = Category::where('nom', $categoryNames[$categorySlug])->first();
            
            if (!$category) {
                continue;
            }

            // Get real location or use default
            $locationData = $locationMapping[$nomSlug] ?? ['location' => 'Dubai', 'emirate' => 'Dubai'];

            // Create activity
            Activity::create([
                'nom' => ucwords(str_replace('-', ' ', $nomSlug)),
                'nom_en' => ucwords(str_replace('-', ' ', $nomEn)),
                'slug' => $nomSlug,
                'description' => ucfirst(str_replace('-', ' ', $description)),
                'description_en' => ucfirst(str_replace('-', ' ', $descriptionEn)),
                'prix' => $prix,
                'location' => $locationData['location'],
                'emirate' => $locationData['emirate'],
                'notes' => rand(40, 50) / 10, // Random rating between 4.0 and 5.0
                'categorie_id' => $category->id,
                'images' => ['images/default.jpg'], // Using default image
            ]);
        }

        fclose($handle);
    }
}

