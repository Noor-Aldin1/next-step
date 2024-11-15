<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OfferNotification;

class EmailController extends Controller
{
    public function sendOffer(Request $request)
    {
        // Validate the email input
        $request->validate([
            'EMAIL' => 'required|email',
        ]);

        // Prepare the offer details
        $offerDetails = [
            'title' => 'Special Job Offer!',
            'message' => 'We have a special job opportunity just for you. Check it out now!',
            'link' => url('/jobs'), // Replace with your actual offers page
        ];

        // Send the email
        Mail::to($request->input('EMAIL'))->send(new OfferNotification($offerDetails));

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Offer email sent successfully!');
    }
}
