<?php
// Modified by Claude

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Commande;
use App\Models\Activity;
use App\Mail\OrderConfirmation;
use App\Mail\OrderNotificationAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CommandeController extends Controller
{
    /**
     * Store new order
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'activities' => 'required|array|min:1',
            'activities.*' => 'integer|exists:activities,id',
            'activities_quantities' => 'required|array',
            'activities_quantities.*' => 'integer|min:1|max:50',
            'datetime' => 'required|string',
            'message' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            // Create or find client
            $client = Client::firstOrCreate(
                ['email' => $request->email],
                [
                    'prenom' => $request->prenom,
                    'nom' => $request->nom,
                    'phone' => $request->telephone,
                ]
            );

            // Get activity details and calculate total
            $activities = Activity::with('category')->whereIn('id', $request->activities)->get();
            $activitiesQuantities = $request->activities_quantities;
            
            $montantTotal = 0;
            foreach ($activities as $activity) {
                $quantity = $activitiesQuantities[$activity->id] ?? 1;
                $montantTotal += $activity->prix * $quantity;
            }

            // Create order
            $commande = Commande::create([
                'client_id' => $client->id,
                'activities' => $request->activities,
                'activities_quantities' => $activitiesQuantities,
                'datetime' => $request->datetime ?? now(),
                'montant_total' => $montantTotal,
                'statut' => 'en_attente',
            ]);

            // Generate WhatsApp message
            $whatsappNumber = '971582032582'; // KENDEA WhatsApp number
            $message = "🎉 *Nouvelle Commande KENDEA*\n\n";
            $message .= "👤 *Client:* {$client->prenom} {$client->nom}\n";
            $message .= "📧 *Email:* {$client->email}\n";
            $message .= "📱 *Téléphone:* {$client->phone}\n\n";
            $message .= "🎯 *Activités commandées:*\n";

            foreach ($activities as $index => $activity) {
                $quantity = $activitiesQuantities[$activity->id] ?? 1;
                $subtotal = $activity->prix * $quantity;
                $message .= ($index + 1) . ". {$activity->nom}\n";
                $message .= "   👥 {$quantity} invité(s) × " . number_format($activity->prix, 2) . " AED = " . number_format($subtotal, 2) . " AED\n";
            }

            $message .= "\n💰 *Total:* " . number_format($montantTotal, 2) . " AED\n";

            if ($request->datetime) {
                $message .= "📅 *Date souhaitée:* {$request->datetime}\n";
            }

            if ($request->message) {
                $message .= "\n💬 *Message:* {$request->message}\n";
            }

            $message .= "\n🆔 *Commande #:* {$commande->id}";

            $whatsappUrl = "https://wa.me/{$whatsappNumber}?text=" . urlencode($message);

            // Send emails
            try {
                Mail::send(new OrderConfirmation($commande, $client, $activities));
                Mail::send(new OrderNotificationAdmin($commande, $client, $activities));
            } catch (\Exception $mailError) {
                // Continue even if email fails
                \Log::warning('Email sending failed: ' . $mailError->getMessage());
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Commande créée avec succès',
                'whatsapp_url' => $whatsappUrl,
                'commande_id' => $commande->id,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création de la commande',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}