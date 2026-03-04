<?php
// Modified by Claude

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation;
use App\Mail\OrderNotificationAdmin;
use App\Models\Client;
use App\Models\Commande;
use App\Models\Activity;

class TestOrderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:order-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test OrderConfirmation et OrderNotificationAdmin avec les destinataires configurés';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🧪 Test des emails de commande...');
        
        // Create test client
        $client = new Client([
            'prenom' => 'Jean',
            'nom' => 'Dupont',
            'email' => 'test.client@example.com',
            'phone' => '+33612345678',
        ]);

        // Get first 2 activities for test
        $activities = Activity::take(2)->get();
        
        if ($activities->isEmpty()) {
            $this->error('❌ Aucune activité trouvée dans la base de données.');
            $this->line('💡 Exécutez: php artisan db:seed');
            return Command::FAILURE;
        }

        // Create test commande
        $commande = new Commande([
            'id' => 999,
            'client_id' => 1,
            'activities' => $activities->pluck('id')->toArray(),
            'datetime' => now(),
            'montant_total' => $activities->sum('prix'),
            'statut' => 'en_attente',
        ]);

        try {
            $this->info('');
            $this->info('📧 Test 1: OrderConfirmation');
            Mail::send(new OrderConfirmation($commande, $client, $activities));
            $this->info('✅ OrderConfirmation envoyé avec succès!');
            $this->line('   📧 Destinataire: test.client@example.com');
            $this->line('   ↩️  Reply-To: admin@kendeatravel.com');
            
            $this->info('');
            $this->info('📧 Test 2: OrderNotificationAdmin');
            Mail::send(new OrderNotificationAdmin($commande, $client, $activities));
            $this->info('✅ OrderNotificationAdmin envoyé avec succès!');
            $this->line('   📧 Destinataire: admin@kendeatravel.com');
            
            $this->info('');
            $this->info('🎉 Tous les emails ont été envoyés avec succès!');
            
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('❌ Erreur lors de l\'envoi: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
