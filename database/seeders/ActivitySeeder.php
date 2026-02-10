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
     * Run the database seeds - 50 activities (5 per category) - Bilingual FR/EN
     */
    public function run(): void
    {
        $activities = [
            // 1. Monuments Emblématiques et Architecture Moderne
            [
                'nom' => 'Burj Khalifa - Observatoire At The Top',
                'nom_en' => 'Burj Khalifa - At The Top Observatory',
                'description' => 'Montez au sommet de la plus haute tour du monde (828m). Vue panoramique à 360° depuis les étages 124 et 125. Accès coupe-file et audio-guide inclus.',
                'description_en' => 'Ascend to the top of the world\'s tallest building (828m). 360° panoramic views from floors 124 and 125. Skip-the-line access and audio guide included.',
                'prix' => 179.00,
                'location' => 'Downtown Dubai',
                'emirate' => 'Dubai',
                'notes' => 4.9,
                'category' => 'Monuments Emblématiques et Architecture Moderne'
            ],
            [
                'nom' => 'Museum of the Future',
                'nom_en' => 'Museum of the Future',
                'description' => 'Explorez le musée le plus innovant au monde avec son architecture futuriste. Découvrez les technologies de demain à travers des expériences immersives.',
                'description_en' => 'Explore the world\'s most innovative museum with futuristic architecture. Discover tomorrow\'s technologies through immersive experiences.',
                'prix' => 145.00,
                'location' => 'Sheikh Zayed Road',
                'emirate' => 'Dubai',
                'notes' => 4.8,
                'category' => 'Monuments Emblématiques et Architecture Moderne'
            ],
            [
                'nom' => 'Palm Jumeirah - The View',
                'nom_en' => 'Palm Jumeirah - The View',
                'description' => 'Admirez la vue spectaculaire sur l\'île artificielle Palm Jumeirah depuis l\'observatoire au 52ème étage. Expérience interactive et café panoramique.',
                'description_en' => 'Admire spectacular views of the artificial Palm Jumeirah island from the 52nd floor observatory. Interactive experience and panoramic café.',
                'prix' => 105.00,
                'location' => 'Palm Jumeirah',
                'emirate' => 'Dubai',
                'notes' => 4.7,
                'category' => 'Monuments Emblématiques et Architecture Moderne'
            ],
            [
                'nom' => 'Sheikh Zayed Grand Mosque',
                'nom_en' => 'Sheikh Zayed Grand Mosque',
                'description' => 'Visitez l\'une des plus grandes mosquées au monde avec ses 82 dômes et architecture époustouflante en marbre blanc. Visite guidée gratuite incluse.',
                'description_en' => 'Visit one of the world\'s largest mosques with 82 domes and stunning white marble architecture. Free guided tour included.',
                'prix' => 0.00,
                'location' => 'Abu Dhabi',
                'emirate' => 'Abu Dhabi',
                'notes' => 5.0,
                'category' => 'Monuments Emblématiques et Architecture Moderne'
            ],
            [
                'nom' => 'Dubai Frame',
                'nom_en' => 'Dubai Frame',
                'description' => 'Cadre géant de 150m offrant une vue unique sur le vieux et le nouveau Dubaï. Sol en verre transparent et exposition historique.',
                'description_en' => 'Giant 150m frame offering unique views of old and new Dubai. Transparent glass floor and historical exhibition.',
                'prix' => 52.00,
                'location' => 'Zabeel Park',
                'emirate' => 'Dubai',
                'notes' => 4.5,
                'category' => 'Monuments Emblématiques et Architecture Moderne'
            ],

            // 2. Aventures dans le Désert
            [
                'nom' => 'Safari Désert avec Dîner BBQ',
                'nom_en' => 'Desert Safari with BBQ Dinner',
                'description' => 'Safari en 4x4 dans les dunes rouges, dune bashing, sandboard, balade à chameau et dîner BBQ sous les étoiles avec spectacles traditionnels.',
                'description_en' => 'Red dunes 4x4 safari, dune bashing, sandboarding, camel ride and BBQ dinner under the stars with traditional shows.',
                'prix' => 250.00,
                'location' => 'Dubai Desert Conservation Reserve',
                'emirate' => 'Dubai',
                'notes' => 4.8,
                'category' => 'Aventures dans le Désert'
            ],
            [
                'nom' => 'Vol en Montgolfière au Lever du Soleil',
                'nom_en' => 'Hot Air Balloon Sunrise Flight',
                'description' => 'Survol magique du désert au lever du soleil (1h). Vue imprenable sur les dunes, oryx et gazelles. Petit-déjeuner champêtre et certificat de vol inclus.',
                'description_en' => 'Magical sunrise desert flight (1h). Stunning views of dunes, oryx and gazelles. Champagne breakfast and flight certificate included.',
                'prix' => 1200.00,
                'location' => 'Margham Desert',
                'emirate' => 'Dubai',
                'notes' => 5.0,
                'category' => 'Aventures dans le Désert'
            ],
            [
                'nom' => 'Quad Bike Adventure dans le Désert',
                'nom_en' => 'Quad Bike Desert Adventure',
                'description' => 'Conduisez votre propre quad à travers les dunes dorées. Session de 1h à 2h avec équipement de sécurité et instructeur. Tous niveaux acceptés.',
                'description_en' => 'Drive your own quad through golden dunes. 1-2h session with safety gear and instructor. All levels welcome.',
                'prix' => 295.00,
                'location' => 'Lehbab Desert',
                'emirate' => 'Dubai',
                'notes' => 4.7,
                'category' => 'Aventures dans le Désert'
            ],
            [
                'nom' => 'Overnight Desert Camp Experience',
                'nom_en' => 'Overnight Desert Camp Experience',
                'description' => 'Nuit authentique en camp bédouin avec dîner traditionnel, spectacles, observation des étoiles et petit-déjeuner. Tentes confortables avec lits.',
                'description_en' => 'Authentic night in Bedouin camp with traditional dinner, shows, stargazing and breakfast. Comfortable tents with beds.',
                'prix' => 450.00,
                'location' => 'Al Marmoom Desert',
                'emirate' => 'Dubai',
                'notes' => 4.9,
                'category' => 'Aventures dans le Désert'
            ],
            [
                'nom' => 'Safari Fauconnerie et Oryx',
                'nom_en' => 'Falconry and Oryx Safari',
                'description' => 'Safari écologique matinal pour observer oryx, gazelles et faucons en liberté. Démonstration de fauconnerie traditionnelle et petit-déjeuner.',
                'description_en' => 'Morning ecological safari to observe wild oryx, gazelles and falcons. Traditional falconry demonstration and breakfast.',
                'prix' => 380.00,
                'location' => 'Dubai Desert Conservation Reserve',
                'emirate' => 'Dubai',
                'notes' => 4.8,
                'category' => 'Aventures dans le Désert'
            ],

            // 3. Parcs à Thèmes et Attractions Familiales
            [
                'nom' => 'Atlantis Aquaventure Waterpark',
                'nom_en' => 'Atlantis Aquaventure Waterpark',
                'description' => 'Plus grand parc aquatique du Moyen-Orient avec 105 toboggans, rivière sauvage, plage privée et accès à l\'aquarium The Lost Chambers.',
                'description_en' => 'Middle East\'s largest waterpark with 105 slides, wild river, private beach and access to The Lost Chambers aquarium.',
                'prix' => 299.00,
                'location' => 'Palm Jumeirah',
                'emirate' => 'Dubai',
                'notes' => 4.8,
                'category' => 'Parcs à Thèmes et Attractions Familiales'
            ],
            [
                'nom' => 'Ferrari World Abu Dhabi',
                'nom_en' => 'Ferrari World Abu Dhabi',
                'description' => 'Plus grand parc à thème couvert au monde dédié à Ferrari. Montagne russe la plus rapide (240 km/h), simulateurs F1 et attractions pour tous.',
                'description_en' => 'World\'s largest indoor theme park dedicated to Ferrari. World\'s fastest roller coaster (240 km/h), F1 simulators and attractions for all.',
                'prix' => 310.00,
                'location' => 'Yas Island',
                'emirate' => 'Abu Dhabi',
                'notes' => 4.7,
                'category' => 'Parcs à Thèmes et Attractions Familiales'
            ],
            [
                'nom' => 'IMG Worlds of Adventure',
                'nom_en' => 'IMG Worlds of Adventure',
                'description' => 'Plus grand parc d\'attractions couvert au monde climatisé. Zones Marvel, Cartoon Network et Dinosaures avec 17 attractions sensationnelles.',
                'description_en' => 'World\'s largest indoor air-conditioned theme park. Marvel, Cartoon Network and Dinosaur zones with 17 thrilling rides.',
                'prix' => 285.00,
                'location' => 'City of Arabia',
                'emirate' => 'Dubai',
                'notes' => 4.6,
                'category' => 'Parcs à Thèmes et Attractions Familiales'
            ],
            [
                'nom' => 'Ski Dubai - Billet Journée Complète',
                'nom_en' => 'Ski Dubai - Full Day Pass',
                'description' => 'Station de ski intérieure avec 5 pistes, télésiège, snow park et rencontre avec les pingouins. Location d\'équipement incluse.',
                'description_en' => 'Indoor ski resort with 5 slopes, chairlift, snow park and penguin encounter. Equipment rental included.',
                'prix' => 210.00,
                'location' => 'Mall of the Emirates',
                'emirate' => 'Dubai',
                'notes' => 4.5,
                'category' => 'Parcs à Thèmes et Attractions Familiales'
            ],
            [
                'nom' => 'Warner Bros. World Abu Dhabi',
                'nom_en' => 'Warner Bros. World Abu Dhabi',
                'description' => 'Parc à thème intérieur avec 29 attractions basées sur les personnages DC Comics, Looney Tunes et Hanna-Barbera. Climatisé et ouvert toute l\'année.',
                'description_en' => 'Indoor theme park with 29 rides based on DC Comics, Looney Tunes and Hanna-Barbera characters. Air-conditioned and open year-round.',
                'prix' => 295.00,
                'location' => 'Yas Island',
                'emirate' => 'Abu Dhabi',
                'notes' => 4.7,
                'category' => 'Parcs à Thèmes et Attractions Familiales'
            ],

            // 4. Nature et Sports d\'Aventure
            [
                'nom' => 'Jebel Jais Zipline - La Plus Longue au Monde',
                'nom_en' => 'Jebel Jais Zipline - World\'s Longest',
                'description' => 'Tyrolienne la plus longue au monde (2,83 km) à 120 km/h au-dessus des montagnes Hajar. Altitude de départ 1680m. Expérience inoubliable.',
                'description_en' => 'World\'s longest zipline (2.83 km) at 120 km/h over Hajar Mountains. Starting altitude 1680m. Unforgettable experience.',
                'prix' => 650.00,
                'location' => 'Jebel Jais',
                'emirate' => 'Ras Al Khaimah',
                'notes' => 5.0,
                'category' => 'Nature et Sports d\'Aventure'
            ],
            [
                'nom' => 'Kayak dans les Mangroves d\'Abu Dhabi',
                'nom_en' => 'Abu Dhabi Mangrove Kayaking',
                'description' => 'Pagayez à travers les mangroves préservées, observez flamants roses, hérons et tortues marines. Tour guidé écologique de 2h.',
                'description_en' => 'Paddle through pristine mangroves, observe flamingos, herons and sea turtles. 2h guided ecological tour.',
                'prix' => 160.00,
                'location' => 'Eastern Mangroves',
                'emirate' => 'Abu Dhabi',
                'notes' => 4.7,
                'category' => 'Nature et Sports d\'Aventure'
            ],
            [
                'nom' => 'Randonnée à Hatta avec Kayak au Barrage',
                'nom_en' => 'Hatta Hiking with Dam Kayaking',
                'description' => 'Randonnée guidée dans les montagnes Hajar suivie de kayak sur le lac turquoise de Hatta Dam. Paysages spectaculaires garantis.',
                'description_en' => 'Guided hiking in Hajar Mountains followed by kayaking on turquoise Hatta Dam lake. Spectacular scenery guaranteed.',
                'prix' => 280.00,
                'location' => 'Hatta',
                'emirate' => 'Dubai',
                'notes' => 4.8,
                'category' => 'Nature et Sports d\'Aventure'
            ],
            [
                'nom' => 'Plongée à Fujairah - Récifs Coralliens',
                'nom_en' => 'Fujairah Diving - Coral Reefs',
                'description' => 'Plongée dans les meilleurs sites de la côte Est des EAU. Récifs coralliens colorés, poissons tropicaux et tortues. Certificat PADI requis.',
                'description_en' => 'Diving at UAE East Coast\'s best sites. Colorful coral reefs, tropical fish and turtles. PADI certificate required.',
                'prix' => 380.00,
                'location' => 'Dibba Rock',
                'emirate' => 'Fujairah',
                'notes' => 4.9,
                'category' => 'Nature et Sports d\'Aventure'
            ],
            [
                'nom' => 'VTT Mountain Biking à Jebel Hafeet',
                'nom_en' => 'Mountain Biking at Jebel Hafeet',
                'description' => 'Descente en VTT sur le deuxième plus haut sommet des EAU (1240m). Pistes techniques et panoramas désertiques exceptionnels.',
                'description_en' => 'Mountain biking descent from UAE\'s second highest peak (1240m). Technical trails and exceptional desert panoramas.',
                'prix' => 220.00,
                'location' => 'Jebel Hafeet',
                'emirate' => 'Abu Dhabi',
                'notes' => 4.6,
                'category' => 'Nature et Sports d\'Aventure'
            ],

            // 5. Culture et Exploration Historique
            [
                'nom' => 'Louvre Abu Dhabi - Visite Guidée',
                'nom_en' => 'Louvre Abu Dhabi - Guided Tour',
                'description' => 'Musée universel avec chef-d\'œuvres de Léonard de Vinci, Van Gogh et art contemporain. Architecture iconique de Jean Nouvel.',
                'description_en' => 'Universal museum with masterpieces by Leonardo da Vinci, Van Gogh and contemporary art. Iconic architecture by Jean Nouvel.',
                'prix' => 63.00,
                'location' => 'Saadiyat Island',
                'emirate' => 'Abu Dhabi',
                'notes' => 4.9,
                'category' => 'Culture et Exploration Historique'
            ],
            [
                'nom' => 'Al Fahidi Historical District Tour',
                'nom_en' => 'Al Fahidi Historical District Tour',
                'description' => 'Explorez le vieux Dubaï avec ses maisons traditionnelles en pierre de corail, galeries d\'art et musée. Guide francophone inclus.',
                'description_en' => 'Explore old Dubai with traditional coral stone houses, art galleries and museum. French-speaking guide included.',
                'prix' => 75.00,
                'location' => 'Bur Dubai',
                'emirate' => 'Dubai',
                'notes' => 4.5,
                'category' => 'Culture et Exploration Historique'
            ],
            [
                'nom' => 'Souks Traditionnels - Gold & Spice',
                'nom_en' => 'Traditional Souks - Gold & Spice',
                'description' => 'Visite guidée des célèbres souks de l\'or et des épices. Démonstration de fabrication de bijoux et dégustation d\'épices. Traversée en abra incluse.',
                'description_en' => 'Guided tour of famous Gold and Spice Souks. Jewelry making demonstration and spice tasting. Abra crossing included.',
                'prix' => 85.00,
                'location' => 'Deira',
                'emirate' => 'Dubai',
                'notes' => 4.6,
                'category' => 'Culture et Exploration Historique'
            ],
            [
                'nom' => 'Qasr Al Watan - Palais Présidentiel',
                'nom_en' => 'Qasr Al Watan - Presidential Palace',
                'description' => 'Visitez le palais présidentiel d\'Abu Dhabi avec ses salles somptueuses, bibliothèque et spectacle lumineux nocturne.',
                'description_en' => 'Visit Abu Dhabi\'s Presidential Palace with sumptuous halls, library and nightly light show.',
                'prix' => 65.00,
                'location' => 'Abu Dhabi',
                'emirate' => 'Abu Dhabi',
                'notes' => 4.8,
                'category' => 'Culture et Exploration Historique'
            ],
            [
                'nom' => 'Sharjah Heritage Tour - Musées',
                'nom_en' => 'Sharjah Heritage Tour - Museums',
                'description' => 'Découverte de la capitale culturelle des EAU avec 6 musées patrimoniaux, souks restaurés et fort historique.',
                'description_en' => 'Discover UAE\'s cultural capital with 6 heritage museums, restored souks and historic fort.',
                'prix' => 95.00,
                'location' => 'Heart of Sharjah',
                'emirate' => 'Sharjah',
                'notes' => 4.5,
                'category' => 'Culture et Exploration Historique'
            ],

            // 6. Gastronomie, Shopping et Vie Nocturne
            [
                'nom' => 'Dinner in the Sky Dubai',
                'nom_en' => 'Dinner in the Sky Dubai',
                'description' => 'Dîner gastronomique suspendu à 50m dans les airs. Menu 3 services préparé par chef étoilé avec vue panoramique exceptionnelle.',
                'description_en' => 'Gourmet dinner suspended 50m in the air. 3-course menu by Michelin-star chef with exceptional panoramic views.',
                'prix' => 699.00,
                'location' => 'Dubai Marina',
                'emirate' => 'Dubai',
                'notes' => 4.8,
                'category' => 'Gastronomie, Shopping et Vie Nocturne'
            ],
            [
                'nom' => 'Dubai Mall Shopping Experience + Aquarium',
                'nom_en' => 'Dubai Mall Shopping Experience + Aquarium',
                'description' => 'Plus grand centre commercial au monde avec 1200 boutiques, aquarium géant, patinoire olympique et fontaines musicales.',
                'description_en' => 'World\'s largest shopping mall with 1200 stores, giant aquarium, Olympic ice rink and musical fountains.',
                'prix' => 120.00,
                'location' => 'Downtown Dubai',
                'emirate' => 'Dubai',
                'notes' => 4.7,
                'category' => 'Gastronomie, Shopping et Vie Nocturne'
            ],
            [
                'nom' => 'Atlantis Brunch - Buffet Illimité',
                'nom_en' => 'Atlantis Brunch - Unlimited Buffet',
                'description' => 'Brunch légendaire avec plus de 100 plats internationaux, fruits de mer frais, champagne illimité et DJ live.',
                'description_en' => 'Legendary brunch with 100+ international dishes, fresh seafood, unlimited champagne and live DJ.',
                'prix' => 595.00,
                'location' => 'Atlantis The Palm',
                'emirate' => 'Dubai',
                'notes' => 4.9,
                'category' => 'Gastronomie, Shopping et Vie Nocturne'
            ],
            [
                'nom' => 'Soirée VIP dans les Clubs de Dubai',
                'nom_en' => 'Dubai VIP Nightclub Experience',
                'description' => 'Accès VIP aux meilleurs clubs de Dubaï avec table réservée, bouteille premium et service dédié. Transport privé inclus.',
                'description_en' => 'VIP access to Dubai\'s best clubs with reserved table, premium bottle and dedicated service. Private transport included.',
                'prix' => 850.00,
                'location' => 'DIFC / Downtown',
                'emirate' => 'Dubai',
                'notes' => 4.6,
                'category' => 'Gastronomie, Shopping et Vie Nocturne'
            ],
            [
                'nom' => 'High Tea à Burj Al Arab',
                'nom_en' => 'High Tea at Burj Al Arab',
                'description' => 'Afternoon tea dans l\'hôtel 7 étoiles le plus luxueux au monde. Pâtisseries fines, thés d\'exception et vue sur le Golfe.',
                'description_en' => 'Afternoon tea in the world\'s most luxurious 7-star hotel. Fine pastries, exceptional teas and Gulf views.',
                'prix' => 450.00,
                'location' => 'Jumeirah',
                'emirate' => 'Dubai',
                'notes' => 5.0,
                'category' => 'Gastronomie, Shopping et Vie Nocturne'
            ],

            // 7. Croisières et Activités Nautiques
            [
                'nom' => 'Dhow Cruise Marina avec Dîner',
                'nom_en' => 'Marina Dhow Cruise with Dinner',
                'description' => 'Croisière sur boutre traditionnel dans la Marina illuminée. Buffet international, spectacles live et vue sur les gratte-ciels.',
                'description_en' => 'Traditional dhow cruise in illuminated Marina. International buffet, live shows and skyscraper views.',
                'prix' => 180.00,
                'location' => 'Dubai Marina',
                'emirate' => 'Dubai',
                'notes' => 4.7,
                'category' => 'Croisières et Activités Nautiques'
            ],
            [
                'nom' => 'Yacht Privé 4 Heures avec Équipage',
                'nom_en' => 'Private Yacht 4 Hours with Crew',
                'description' => 'Location de yacht luxueux avec capitaine et hôtesse. Équipement sports nautiques, BBQ et boissons. Jusqu\'à 10 personnes.',
                'description_en' => 'Luxury yacht charter with captain and hostess. Water sports equipment, BBQ and drinks. Up to 10 people.',
                'prix' => 2800.00,
                'location' => 'Dubai Marina',
                'emirate' => 'Dubai',
                'notes' => 5.0,
                'category' => 'Croisières et Activités Nautiques'
            ],
            [
                'nom' => 'Jet Ski Tour - Palm Jumeirah',
                'nom_en' => 'Jet Ski Tour - Palm Jumeirah',
                'description' => 'Tour guidé en jet ski autour de Palm Jumeirah et Atlantis. Session 1h avec guide et arrêt photos devant Burj Al Arab.',
                'description_en' => 'Guided jet ski tour around Palm Jumeirah and Atlantis. 1h session with guide and photo stop at Burj Al Arab.',
                'prix' => 450.00,
                'location' => 'Palm Jumeirah',
                'emirate' => 'Dubai',
                'notes' => 4.8,
                'category' => 'Croisières et Activités Nautiques'
            ],
            [
                'nom' => 'Speedboat Tour - Dubai Marina & Atlantis',
                'nom_en' => 'Speedboat Tour - Dubai Marina & Atlantis',
                'description' => 'Tour adrénaline en speedboat le long de la côte avec vue sur Burj Al Arab, Atlantis et Palm. Gilets fournis.',
                'description_en' => 'Adrenaline speedboat tour along coast with views of Burj Al Arab, Atlantis and Palm. Life jackets provided.',
                'prix' => 350.00,
                'location' => 'Dubai Marina',
                'emirate' => 'Dubai',
                'notes' => 4.7,
                'category' => 'Croisières et Activités Nautiques'
            ],
            [
                'nom' => 'Flyboard & Parasailing Combo',
                'nom_en' => 'Flyboard & Parasailing Combo',
                'description' => 'Package combinant flyboard (15 min) et parasailing (15 min) au-dessus du Golfe Persique. Formation et équipement inclus.',
                'description_en' => 'Package combining flyboard (15 min) and parasailing (15 min) over the Persian Gulf. Training and equipment included.',
                'prix' => 480.00,
                'location' => 'JBR Beach',
                'emirate' => 'Dubai',
                'notes' => 4.6,
                'category' => 'Croisières et Activités Nautiques'
            ],

            // 8. Festivals, Événements et Activités Saisonnières
            [
                'nom' => 'Global Village - Billet d\'Entrée',
                'nom_en' => 'Global Village - Entry Ticket',
                'description' => 'Parc multiculturel saisonnier (Oct-Avr) avec pavillons de 90 pays, spectacles, shopping et cuisine du monde. Feux d\'artifice le weekend.',
                'description_en' => 'Seasonal multicultural park (Oct-Apr) with pavilions from 90 countries, shows, shopping and world cuisine. Weekend fireworks.',
                'prix' => 25.00,
                'location' => 'Dubai Land',
                'emirate' => 'Dubai',
                'notes' => 4.5,
                'category' => 'Festivals, Événements et Activités Saisonnières'
            ],
            [
                'nom' => 'Dubai Shopping Festival - Tour Shopping VIP',
                'nom_en' => 'Dubai Shopping Festival - VIP Shopping Tour',
                'description' => 'Tour shopping organisé pendant le festival (Janv-Fév) avec personal shopper, réductions exclusives et accès VIP aux tirages au sort.',
                'description_en' => 'Organized shopping tour during festival (Jan-Feb) with personal shopper, exclusive discounts and VIP raffle access.',
                'prix' => 350.00,
                'location' => 'Dubai Malls',
                'emirate' => 'Dubai',
                'notes' => 4.6,
                'category' => 'Festivals, Événements et Activités Saisonnières'
            ],
            [
                'nom' => 'Réveillon du Nouvel An à Burj Khalifa',
                'nom_en' => 'New Year\'s Eve at Burj Khalifa',
                'description' => 'Soirée premium pour le feu d\'artifice du Nouvel An le plus spectaculaire au monde. Accès observatoire, champagne et buffet.',
                'description_en' => 'Premium evening for world\'s most spectacular New Year\'s Eve fireworks. Observatory access, champagne and buffet.',
                'prix' => 1500.00,
                'location' => 'Downtown Dubai',
                'emirate' => 'Dubai',
                'notes' => 5.0,
                'category' => 'Festivals, Événements et Activités Saisonnières'
            ],
            [
                'nom' => 'Dubai Food Festival - Tour Gastronomique',
                'nom_en' => 'Dubai Food Festival - Gourmet Tour',
                'description' => 'Tour culinaire guidé pendant le festival (Fév-Mars) avec dégustation dans 5 restaurants étoilés et rencontre avec chefs.',
                'description_en' => 'Guided culinary tour during festival (Feb-Mar) with tasting at 5 Michelin-star restaurants and chef meetings.',
                'prix' => 680.00,
                'location' => 'DIFC / Downtown',
                'emirate' => 'Dubai',
                'notes' => 4.8,
                'category' => 'Festivals, Événements et Activités Saisonnières'
            ],
            [
                'nom' => 'Abu Dhabi F1 Grand Prix - Tickets Tribune',
                'nom_en' => 'Abu Dhabi F1 Grand Prix - Grandstand Tickets',
                'description' => 'Billets pour le Grand Prix F1 d\'Abu Dhabi sur Yas Marina Circuit. Accès tribune principale, après-courses concerts et paddock.',
                'description_en' => 'Tickets for Abu Dhabi F1 Grand Prix at Yas Marina Circuit. Main grandstand access, after-race concerts and paddock.',
                'prix' => 950.00,
                'location' => 'Yas Marina Circuit',
                'emirate' => 'Abu Dhabi',
                'notes' => 5.0,
                'category' => 'Festivals, Événements et Activités Saisonnières'
            ],

            // 9. Expériences de Luxe et Bien-être
            [
                'nom' => 'Spa de Luxe Talise à Burj Al Arab',
                'nom_en' => 'Talise Luxury Spa at Burj Al Arab',
                'description' => 'Journée spa exclusive dans l\'hôtel 7 étoiles. Massage signature 90 min, soins du visage, accès piscine infinie et collations gastronomiques.',
                'description_en' => 'Exclusive spa day in 7-star hotel. 90-min signature massage, facial treatment, infinity pool access and gourmet refreshments.',
                'prix' => 1200.00,
                'location' => 'Burj Al Arab',
                'emirate' => 'Dubai',
                'notes' => 5.0,
                'category' => 'Expériences de Luxe et Bien-être'
            ],
            [
                'nom' => 'Séjour Wellness à Anantara Desert Resort',
                'nom_en' => 'Wellness Stay at Anantara Desert Resort',
                'description' => 'Package bien-être 2 jours/1 nuit en resort 5 étoiles dans le désert. Yoga au lever du soleil, spa, cuisine saine et activités nature.',
                'description_en' => '2-day/1-night wellness package at 5-star desert resort. Sunrise yoga, spa, healthy cuisine and nature activities.',
                'prix' => 2500.00,
                'location' => 'Al Wathba Desert',
                'emirate' => 'Abu Dhabi',
                'notes' => 4.9,
                'category' => 'Expériences de Luxe et Bien-être'
            ],
            [
                'nom' => 'Personal Shopping avec Styliste',
                'nom_en' => 'Personal Shopping with Stylist',
                'description' => 'Service VIP de 4h avec styliste professionnel dans les boutiques de luxe. Conseil mode, sélection personnalisée et café privé.',
                'description_en' => '4h VIP service with professional stylist in luxury boutiques. Fashion advice, personalized selection and private café.',
                'prix' => 450.00,
                'location' => 'Dubai Mall / Mall of Emirates',
                'emirate' => 'Dubai',
                'notes' => 4.7,
                'category' => 'Expériences de Luxe et Bien-être'
            ],
            [
                'nom' => 'Séance Photo Professionnelle à Dubai',
                'nom_en' => 'Professional Photo Shoot in Dubai',
                'description' => 'Séance photo 2h avec photographe pro aux sites iconiques (Burj Khalifa, Marina, désert). 50 photos retouchées livrées.',
                'description_en' => '2h photo shoot with pro photographer at iconic sites (Burj Khalifa, Marina, desert). 50 retouched photos delivered.',
                'prix' => 580.00,
                'location' => 'Multiple Locations',
                'emirate' => 'Dubai',
                'notes' => 4.8,
                'category' => 'Expériences de Luxe et Bien-être'
            ],
            [
                'nom' => 'Helicopter Champagne Sunset Tour',
                'nom_en' => 'Helicopter Champagne Sunset Tour',
                'description' => 'Vol en hélicoptère privé au coucher du soleil avec service champagne. Survol de Palm, Burj Khalifa et côte. 45 minutes.',
                'description_en' => 'Private helicopter sunset flight with champagne service. Overfly Palm, Burj Khalifa and coastline. 45 minutes.',
                'prix' => 3200.00,
                'location' => 'Dubai Marina Heliport',
                'emirate' => 'Dubai',
                'notes' => 5.0,
                'category' => 'Expériences de Luxe et Bien-être'
            ],

            // 10. Sports Extrêmes et Sensations Fortes
            [
                'nom' => 'Skydive Dubai - Saut en Tandem',
                'nom_en' => 'Skydive Dubai - Tandem Jump',
                'description' => 'Saut en parachute tandem au-dessus de Palm Jumeirah de 4000m. Chute libre 60 secondes, vidéo HD et photos incluses.',
                'description_en' => 'Tandem skydive over Palm Jumeirah from 4000m. 60-second freefall, HD video and photos included.',
                'prix' => 2199.00,
                'location' => 'Palm Dropzone',
                'emirate' => 'Dubai',
                'notes' => 5.0,
                'category' => 'Sports Extrêmes et Sensations Fortes'
            ],
            [
                'nom' => 'XLine Dubai Marina Zipline',
                'nom_en' => 'XLine Dubai Marina Zipline',
                'description' => 'Tyrolienne urbaine la plus longue au monde (1 km) entre les gratte-ciels de la Marina à 170m de haut. Vitesse 80 km/h.',
                'description_en' => 'World\'s longest urban zipline (1 km) between Marina skyscrapers at 170m high. Speed 80 km/h.',
                'prix' => 650.00,
                'location' => 'Dubai Marina',
                'emirate' => 'Dubai',
                'notes' => 4.9,
                'category' => 'Sports Extrêmes et Sensations Fortes'
            ],
            [
                'nom' => 'Deep Dive Dubai - Plongée 60m',
                'nom_en' => 'Deep Dive Dubai - 60m Dive',
                'description' => 'Plongée dans la piscine la plus profonde au monde (60m). Ville submergée à explorer avec instructeur certifié. Expérience unique.',
                'description_en' => 'Dive in world\'s deepest pool (60m). Submerged city to explore with certified instructor. Unique experience.',
                'prix' => 1200.00,
                'location' => 'Nad Al Sheba',
                'emirate' => 'Dubai',
                'notes' => 5.0,
                'category' => 'Sports Extrêmes et Sensations Fortes'
            ],
            [
                'nom' => 'iFly Dubai - Chute Libre Indoor',
                'nom_en' => 'iFly Dubai - Indoor Skydiving',
                'description' => 'Simulation de chute libre dans tunnel vertical avec vents à 270 km/h. 2 vols avec instructeur. Aucune expérience requise.',
                'description_en' => 'Freefall simulation in vertical wind tunnel at 270 km/h. 2 flights with instructor. No experience required.',
                'prix' => 275.00,
                'location' => 'City Centre Mirdif',
                'emirate' => 'Dubai',
                'notes' => 4.7,
                'category' => 'Sports Extrêmes et Sensations Fortes'
            ],
            [
                'nom' => 'Conduite sur Circuit F1 - Yas Marina',
                'nom_en' => 'F1 Track Driving - Yas Marina',
                'description' => 'Conduisez une Formule 1 ou supercar sur le circuit officiel du Grand Prix. Session 30 min avec instructeur pro et briefing.',
                'description_en' => 'Drive a Formula 1 or supercar on official Grand Prix circuit. 30-min session with pro instructor and briefing.',
                'prix' => 1800.00,
                'location' => 'Yas Marina Circuit',
                'emirate' => 'Abu Dhabi',
                'notes' => 5.0,
                'category' => 'Sports Extrêmes et Sensations Fortes'
            ],
        ];

        foreach ($activities as $activity) {
            $category = Category::where('nom', $activity['category'])->first();
            
            if (!$category) {
                continue;
            }

            Activity::create([
                'nom' => $activity['nom'],
                'nom_en' => $activity['nom_en'],
                'slug' => Str::slug($activity['nom']),
                'description' => $activity['description'],
                'description_en' => $activity['description_en'],
                'prix' => $activity['prix'],
                'location' => $activity['location'],
                'emirate' => $activity['emirate'],
                'categorie_id' => $category->id,
                'images' => $this->generateImagePaths(Str::slug($activity['nom'])),
                'notes' => $activity['notes'],
            ]);
        }
    }

    /**
     * Generate image paths for activity
     */
    private function generateImagePaths(string $slug): array
    {
        $images = [];
        $imageCount = rand(3, 5);

        for ($i = 1; $i <= $imageCount; $i++) {
            $images[] = "storage/activities/{$slug}/image-{$i}.jpg";
        }

        return $images;
    }
}
