<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Mail\ContactConfirmationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
     public function index(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            $contact = new ContactMessage($validated);

            // আগে email পাঠাই
            Mail::to($validated['email'])->send(new ContactConfirmationMail($contact));

            // Email success হলে database-এ save করি
            $contact->save();
            // Mail::to($validated['email'])->send(new ContactConfirmationMail($contact));
            // $contact = ContactMessage::create($validated);
            return response()->json([
                'success' => true,
                'message' => 'Thank you for your message!',
                'data' => $contact,
            ], 201);}
             catch (\Exception $e) {
                // Log the error
                Log::error('Contact Form Error: '.$e->getMessage());

                // Return Error JSON Response
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong. Please try again later!',
                    'error' => $e->getMessage(),
                ], 500);
            }

    }
}
