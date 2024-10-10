<?php

namespace App\Http\Controllers;

use App\Models\Package; // Ensure you have a Package model
use Illuminate\Http\Request;

use App\Models\UserSubscription;
use App\Models\Payment;

class CheckoutController extends Controller
{
    // Display the checkout form with the selected package information
    public function showCheckoutForm(Request $request)
    {
        // Retrieve the package based on the provided ID from the request
        $package = Package::findOrFail($request->input('package_id')); // Use input to fetch package ID
        $numberOfMonths = $request->input('numberOfMonths'); // Get the number of months

        return view('user.pages.checkout', compact('package', 'numberOfMonths')); // Pass the package and number of months to the view
    }

    // Process the checkout and payment
    public function processCheckout(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'numberOfMonths' => 'required|integer|min:1',
            'paymentMethod' => 'required|string',
            'cc-name' => 'required|string|max:255',
            'cc-number' => 'required|string|size:16', // Assuming a 16-digit card number
            'cc-expiration' => 'required|string',
            'cc-cvv' => 'required|string|size:3',
            'package_id' => 'required|integer|exists:packages,id', // Validate package_id exists
        ]);

        // Fetch the package and calculate the total amount
        $package = Package::findOrFail($request->package_id);
        $monthlyPayment = $package->price;
        $totalAmount = $request->numberOfMonths * $monthlyPayment;

        // Simulate payment processing
        $isPaymentSuccessful = $this->simulatePayment($request);

        if ($isPaymentSuccessful) {
            // Payment successful, store subscription details
            $subscription = UserSubscription::create([
                'user_id' => auth()->id(), // Assuming the user is authenticated
                'package_id' => $request->package_id,
                'start_date' => now(), // Start date is now
                'end_date' => now()->addMonths($request->numberOfMonths), // End date based on the number of months
                'number_month' => $request->numberOfMonths,
            ]);

            // Store payment details
            Payment::create([
                'subscription_id' => $subscription->id,
                'amount' => $totalAmount,
                'payment_date' => now(),
                'payment_status' => 'completed', // or whatever status you want to set
            ]);

            // Redirect to success page
            return redirect()->route('checkout.success')->with('success', "Payment of $totalAmount JD completed successfully.");
        } else {
            // Payment failed
            return back()->withErrors(['error' => 'Payment processing failed. Please try again.']);
        }
    }


    // Simulate payment processing logic
    private function simulatePayment(Request $request)
    {
        // Example logic for simulating payment processing
        // In a real application, this would integrate with a payment gateway

        // Validate credit card details (you can expand this as needed)
        if ($request->input('cc-number') === '4111111111111111' && $request->input('cc-cvv') === '123') {
            // Simulating a successful payment for a specific test card
            return true; // Payment simulated as successful
        }

        // Simulate payment failure for any other card
        return false; // Simulating a failed payment
    }


    // Display the success page after a successful payment
    public function checkoutSuccess()
    {
        return view('user.pages.success'); // Create this view for success response
    }
}
