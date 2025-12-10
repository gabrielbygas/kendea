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
            'phone' => 'required|string|max:20',
            'activities' => 'required|array|min:1',
            'activities.*' => 'exists:activities,id',
            'datetime' => 'required|date',
            'montant_total' => 'required|numeric|min:0',
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
                    'phone' => $request->phone,
                ]
            );

            // Create order
            $commande = Commande::create([
                'client_id' => $client->id,
                'activities' => $request->activities,
                'datetime' => $request->datetime,
                'montant_total' => $request->montant_total,
                'statut' => 'en_attente',
            ]);

            // Get activity details for WhatsApp message
            $activities = Activity::whereIn('id', $request->activities)->get();

            // Send confirmation email to client
            Mail::to($client->email)->send(new OrderConfirmation($commande, $client, $activities));

            // Send notification email to admin
            Mail::to('web@gabrielkalala.com')->send(new OrderNotificationAdmin($commande, $client, $activities));

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Commande créée avec succès',
                'commande' => $commande,
                'activities' => $activities,
                'client' => $client,
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
