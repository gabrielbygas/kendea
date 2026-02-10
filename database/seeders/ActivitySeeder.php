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
     * Run the database seeds.
     */
    public function run(): void
    {
        $activitiesData = [
            'Aventures dans le Désert' => [
                'Safari en 4x4' => [
                    'prix' => 150.00,
                    'location' => 'Desert Safari',
                    'description' => 'Explorez le désert de Dubaï en 4x4 avec un chauffeur expérimenté. Profitez des dunes spectaculaires et de l\'adrénaline d\'une aventure inoubliable. Inclut des arrêts photos et une expérience authentique du désert.',
                    'notes' => 4.8
                ],
                'Quad dans les Dunes' => [
                    'prix' => 120.00,
                    'location' => 'Desert Safari',
                    'description' => 'Conduisez votre propre quad à travers les dunes dorées du désert de Dubaï. Une expérience passionnante pour les amateurs de sensations fortes avec équipement de sécurité fourni.',
                    'notes' => 4.6
                ],
                'Sandboarding' => [
                    'prix' => 80.00,
                    'location' => 'Desert Safari',
                    'description' => 'Glissez sur les dunes comme sur la neige. Une expérience unique dans le désert avec planches et instructeurs professionnels. Parfait pour tous les niveaux.',
                    'notes' => 4.4
                ],
                'Camp Bédouin' => [
                    'prix' => 200.00,
                    'location' => 'Desert Safari',
                    'description' => 'Passez une nuit authentique dans un camp bédouin avec dîner traditionnel et spectacles. Découvrez la culture du désert sous les étoiles avec musique live et danse du ventre.',
                    'notes' => 4.9
                ],
                'Vol en Montgolfière' => [
                    'prix' => 350.00,
                    'location' => 'Desert Safari',
                    'description' => 'Admirez le lever du soleil sur le désert depuis une montgolfière. Vue imprenable garantie sur les dunes et la faune sauvage. Inclut certificat de vol et petit-déjeuner champêtre.',
                    'notes' => 5.0
                ],
            ],
            'Attractions Aquatiques' => [
                'Ski Nautique' => [
                    'prix' => 180.00,
                    'location' => 'Dubai Marina',
                    'description' => 'Profitez du ski nautique dans les eaux turquoise de la Marina de Dubaï. Équipement professionnel et instructeurs certifiés. Idéal pour débutants et experts.',
                    'notes' => 4.5
                ],
                'Jet Ski Marina' => [
                    'prix' => 160.00,
                    'location' => 'Dubai Marina',
                    'description' => 'Louez un jet ski et explorez la Marina à votre rythme. Sensations fortes garanties avec vue sur les gratte-ciels. Location d\'une heure avec gilets de sauvetage.',
                    'notes' => 4.7
                ],
                'Plongée Sous-Marine' => [
                    'prix' => 220.00,
                    'location' => 'Jumeirah Beach',
                    'description' => 'Découvrez la vie marine du Golfe Persique avec un instructeur certifié PADI. Exploration de récifs coralliens et épaves. Équipement complet fourni.',
                    'notes' => 4.8
                ],
                'Flyboard Dubai' => [
                    'prix' => 190.00,
                    'location' => 'Jumeirah Beach',
                    'description' => 'Volez au-dessus de l\'eau avec le flyboard. Expérience futuriste et amusante avec formation de 15 minutes. Sensations garanties pour les aventuriers.',
                    'notes' => 4.6
                ],
                'Atlantis Aquaventure' => [
                    'prix' => 95.00,
                    'location' => 'Palm Jumeirah',
                    'description' => 'Parc aquatique le plus spectaculaire de Dubaï avec toboggans géants et plage privée. Plus de 30 attractions aquatiques pour toute la famille. Accès à l\'aquarium inclus.',
                    'notes' => 4.9
                ],
            ],
            'Visites Culturelles' => [
                'Visite du Burj Khalifa' => [
                    'prix' => 140.00,
                    'location' => 'Downtown Dubai',
                    'description' => 'Montez au sommet du plus haut bâtiment du monde. Vue panoramique à 360 degrés depuis le 124ème étage. Accès coupe-file et audioguide en français inclus.',
                    'notes' => 5.0
                ],
                'Tour du Vieux Dubai' => [
                    'prix' => 75.00,
                    'location' => 'Dubai Creek',
                    'description' => 'Découvrez l\'histoire de Dubaï avec visite des souks traditionnels et musées. Guide francophone inclus. Traversée en abra (bateau traditionnel) sur le Creek.',
                    'notes' => 4.5
                ],
                'Musée du Futur' => [
                    'prix' => 110.00,
                    'location' => 'Downtown Dubai',
                    'description' => 'Explorez les innovations technologiques dans ce musée architectural unique. Expériences immersives et interactives sur le futur de l\'humanité.',
                    'notes' => 4.8
                ],
                'Croisière en Dhow' => [
                    'prix' => 130.00,
                    'location' => 'Dubai Creek',
                    'description' => 'Dîner romantique sur un bateau traditionnel avec vue sur la ville illuminée. Buffet international et spectacles en direct. Départ en soirée de Dubai Creek.',
                    'notes' => 4.7
                ],
                'Souk de l\'Or' => [
                    'prix' => 50.00,
                    'location' => 'Deira',
                    'description' => 'Visite guidée du célèbre marché de l\'or avec démonstration de fabrication de bijoux. Plus de 300 boutiques d\'or et pierres précieuses. Guide expert inclus.',
                    'notes' => 4.4
                ],
            ],
            'Sports Extrêmes' => [
                'Parachutisme' => [
                    'prix' => 450.00,
                    'location' => 'Palm Jumeirah',
                    'description' => 'Sautez en tandem au-dessus de Palm Jumeirah. Expérience inoubliable avec instructeur professionnel. Vidéo et photos de votre saut incluses.',
                    'notes' => 5.0
                ],
                'Hélicoptère Panoramique' => [
                    'prix' => 380.00,
                    'location' => 'Dubai Marina',
                    'description' => 'Tour en hélicoptère au-dessus des monuments emblématiques de Dubaï. Survol de Burj Khalifa, Palm Jumeirah et Burj Al Arab. Duration 15-40 minutes.',
                    'notes' => 4.9
                ],
                'Formule 1 Simulateur' => [
                    'prix' => 95.00,
                    'location' => 'Dubai Autodrome',
                    'description' => 'Conduisez des voitures de course sur un circuit professionnel avec instructeur. Voitures Ferrari, Lamborghini disponibles. Briefing de sécurité inclus.',
                    'notes' => 4.6
                ],
                'Indoor Skydiving' => [
                    'prix' => 210.00,
                    'location' => 'City Centre Mirdif',
                    'description' => 'Expérience de chute libre en intérieur dans une soufflerie verticale. Aucune expérience nécessaire. Formation et équipement complet fournis.',
                    'notes' => 4.7
                ],
                'Escalade Burj Khalifa' => [
                    'prix' => 500.00,
                    'location' => 'Downtown Dubai',
                    'description' => 'Escaladez l\'extérieur du Burj Khalifa avec équipement de sécurité professionnel. Expérience unique réservée aux aventuriers. Certificat d\'accomplissement inclus.',
                    'notes' => 5.0
                ],
            ],
            'Expériences de Luxe' => [
                'Spa de Luxe' => [
                    'prix' => 280.00,
                    'location' => 'Burj Al Arab',
                    'description' => 'Journée de détente dans le spa 7 étoiles du Burj Al Arab avec massages et soins. Accès aux installations privées. Thé et collations inclus.',
                    'notes' => 5.0
                ],
                'Dîner Gastronomique' => [
                    'prix' => 320.00,
                    'location' => 'Burj Khalifa',
                    'description' => 'Dîner dans le restaurant Atmosphere au 122ème étage du Burj Khalifa. Menu gastronomique 5 services avec chef étoilé. Vue spectaculaire garantie.',
                    'notes' => 4.9
                ],
                'Yacht Privé' => [
                    'prix' => 600.00,
                    'location' => 'Dubai Marina',
                    'description' => 'Location de yacht privé avec capitaine pour une journée en mer avec vos proches. Équipement de pêche et sports nautiques inclus. Jusqu\'à 10 personnes.',
                    'notes' => 5.0
                ],
                'Shopping Personal Shopper' => [
                    'prix' => 150.00,
                    'location' => 'Dubai Mall',
                    'description' => 'Personal shopper dédié pour une expérience shopping VIP dans les boutiques de luxe. Accès à des ventes privées et conseils mode personnalisés.',
                    'notes' => 4.6
                ],
                'Brunch Atlantis' => [
                    'prix' => 250.00,
                    'location' => 'Palm Jumeirah',
                    'description' => 'Brunch buffet illimité dans le luxueux hôtel Atlantis The Palm. Plus de 100 plats internationaux. Boissons premium et champagne inclus.',
                    'notes' => 4.8
                ],
            ],
        ];

        foreach ($activitiesData as $categoryName => $activities) {
            $category = Category::where('nom', $categoryName)->first();
            
            if (!$category) {
                continue;
            }

            foreach ($activities as $activityName => $data) {
                $slug = Str::slug($activityName);

                Activity::create([
                    'nom' => $activityName,
                    'slug' => $slug,
                    'description' => $data['description'],
                    'prix' => $data['prix'],
                    'location' => $data['location'],
                    'categorie_id' => $category->id,
                    'images' => $this->generateImagePaths($slug),
                    'notes' => $data['notes'],
                ]);
            }
        }
    }

    /**
     * Generate image paths for activity
     */
    private function generateImagePaths(string $slug): array
    {
        $images = [];
        $imageCount = rand(3, 5); // 3 to 5 images per activity

        for ($i = 1; $i <= $imageCount; $i++) {
            $images[] = "storage/activities/{$slug}/image-{$i}.jpg";
        }

        return $images;
    }
}
