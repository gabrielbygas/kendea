<?php
// Modified by Claude

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class TestContactEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:contact-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test ContactFormMail avec les destinataires configurés';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🧪 Test de ContactFormMail...');
        
        $contactData = [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'message' => 'Ceci est un message de test pour vérifier la configuration des emails de contact.'
        ];

        try {
            Mail::send(new ContactFormMail($contactData));
            
            $this->info('✅ Email envoyé avec succès!');
            $this->line('');
            $this->line('📧 Destinataire principal: contact@kendeatravel.com');
            $this->line('📋 CC: admin@kendeatravel.com, david@kendeatravel.com');
            $this->line('↩️  Reply-To: testuser@example.com');
            
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('❌ Erreur lors de l\'envoi: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
