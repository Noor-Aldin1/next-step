<?php

namespace App\Http\Controllers;

use App\Models\Package; // Ensure you have a Package model
use Illuminate\Http\Request;

use App\Models\UserSubscription;
use App\Models\Payment;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    protected function calculateRemainingBalance($user)
    {
        // Get the latest subscription
        $subscription = $user->subscriptions()->latest()->first();

        if ($subscription) {
            // Calculate the number of months used since the start date
            $monthsUsed = now()->diffInMonths($subscription->start_date);

            // Ensure months used does not exceed the total number of months in the subscription
            $monthsUsed = min($monthsUsed, $subscription->number_month);

            // Calculate the remaining months in the subscription
            $remainingMonths = $subscription->number_month - $monthsUsed;

            // Calculate the remaining balance based on the remaining months and the package price
            $remainingBalance = max(0, $remainingMonths * $subscription->package->price);
            // dd();

            return $remainingBalance; // Return the calculated remaining balance
        }

        return 0; // Return 0 if no subscription is found
    }

    // Display the checkout form with the selected package information
    public function showCheckoutForm(Request $request)
    {
        // Retrieve the package based on the provided ID from the request
        $newPackage = Package::findOrFail($request->input('package_id')); // Use input to fetch package ID
        $numberOfMonths = $request->input('numberOfMonths'); // Get the number of months

        // Calculate remaining balance if the user has an existing subscription
        $remainingBalance = $this->calculateRemainingBalance(auth()->user());

        // Initialize total amount based on the new package
        $totalAmount = $newPackage->price; // Default total amount to the package price

        // Adjust the total amount by subtracting the remaining balance
        $totalAmount -= $remainingBalance;

        // Ensure the total amount is not less than zero
        $totalAmount = max(0, $totalAmount);

        return view('user.pages.checkout', compact('newPackage', 'numberOfMonths', 'remainingBalance', 'totalAmount')); // Pass necessary data to the view
    }

    // Process the checkout and payment
    public function processCheckout(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'numberOfMonths' => 'required|integer|min:1',
            // 'paymentMethod' => 'required|string|in:credit,debit,paypal', // Ensure valid payment method is selected
            'cc-name' => 'required|string|max:255',
            'cc-number' => [
                'required',
                'string',
                'regex:/^\d{16}$/' // Ensure the card number is exactly 16 digits
            ],
            'cc-expiration' => [
                'required',
                'string',
                'regex:/^(0[1-9]|1[0-2])\/?([0-9]{2})$/' // Validate MM/YY format for expiration
            ],
            'cc-cvv' => [
                'required',
                'string',
                'regex:/^\d{3,4}$/' // Validate CVV with 3 or 4 digits
            ],
            'package_id' => 'required|integer|exists:packages,id', // Ensure package_id exists in the packages table
            'remaining_balance' => 'nullable|numeric|min:0', // Optional field with validation
        ]);


        // Fetch the new package
        $newPackage = Package::findOrFail($request->package_id);
        $monthlyPayment = $newPackage->price;

        // Check if the user already has an active subscription
        $existingSubscription = UserSubscription::where('user_id', auth()->id())
            ->where('end_date', '>', now())
            ->first();

        // Calculate total amount based on the new subscription
        if ($existingSubscription) {
            // Calculate the remaining value of the existing subscription
            $remainingValue = $this->calculateRemainingBalance(auth()->user());

            // Calculate the total amount for the new subscription after deducting the remaining value
            $totalAmount = ($request->numberOfMonths * $monthlyPayment) - $remainingValue;

            // Ensure total amount is not less than zero
            $totalAmount = max($totalAmount, 0);

            // Update the existing subscription
            $existingSubscription->update([
                'package_id' => $request->package_id,
                Carbon::parse($existingSubscription->end_date)->addMonths($request->numberOfMonths),  // Extend subscription
                'number_month' => $existingSubscription->number_month + $request->numberOfMonths,
            ]);
        } else {
            // If no subscription exists, calculate the full amount
            $totalAmount = $request->numberOfMonths * $monthlyPayment;

            // Create a new subscription
            $existingSubscription = UserSubscription::create([
                'user_id' => auth()->id(),
                'package_id' => $request->package_id,
                'start_date' => now(),
                'end_date' => now()->addMonths($request->numberOfMonths),
                'number_month' => $request->numberOfMonths,
            ]);
        }

        // Simulate payment processing
        $isPaymentSuccessful = $this->simulatePayment($request);

        if ($isPaymentSuccessful) {
            // Store payment details
            Payment::create([
                'subscription_id' => $existingSubscription->id,
                'amount' => $totalAmount,
                'payment_date' => now(),
                'payment_status' => 'completed',
            ]);

            // Redirect to success page
            return redirect()->route('checkout.success')->with('success', "Your subscription has been upgraded and extended by {$request->numberOfMonths} months for $totalAmount JD.");
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
