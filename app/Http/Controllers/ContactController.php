<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Send email to admin
        try {
            Mail::to(config('mail.from.address'))
                ->send(new ContactFormMail($validated));
            
            return response()->json([
                'success' => true,
                'message' => __('Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('Une erreur est survenue lors de l\'envoi du message. Veuillez réessayer.')
            ], 500);
        }
    }
}
