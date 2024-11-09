<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserSubscription;
use App\Models\User;
use App\Models\Package;
use Illuminate\Http\Request;

class AdminSubscriptionController extends Controller
{
    /**
     * Display a listing of the subscriptions.
     */
    public function index()
    {
        $users = User::all()->where('role_id', '=', 1);
        $packages = Package::all();
        $subscriptions = UserSubscription::with(['user', 'package', 'payments'])->paginate(10);
        return view('admin.pages.user.subscription', compact('subscriptions', 'packages', 'users'));
    }

    /**
     * Show the form for creating a new subscription.
     */
    public function create()
    {
        $users = User::all();
        $packages = Package::all();
        return view('admin.subscriptions.create', compact('users', 'packages'));
    }

    /**
     * Store a newly created subscription in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'package_id' => 'required|exists:packages,id',
            'number_month' => 'required|integer|min:1',
            'start_date' => 'required|date|date_format:Y-m-d\TH:i:s', // Make sure it follows the correct datetime format
            'end_date' => 'required|date|date_format:Y-m-d\TH:i:s|after:start_date', // Ensure end_date is after start_date
        ]);

        // Proceed to store the subscription
        $subscription = new UserSubscription();
        $subscription->user_id = $request->input('user_id');
        $subscription->package_id = $request->input('package_id');
        $subscription->number_month = $request->input('number_month');
        $subscription->start_date = $request->input('start_date');
        $subscription->end_date = $request->input('end_date');
        $subscription->save();

        return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription added successfully.');
    }


    /**
     * Display the specified subscription.
     */
    public function show($id)
    {
        $subscription = UserSubscription::with(['user', 'package', 'payments'])->findOrFail($id);
        return view('admin.subscriptions.show', compact('subscription'));
    }

    /**
     * Show the form for editing the specified subscription.
     */
    public function edit($id)
    {
        $subscription = UserSubscription::findOrFail($id);
        $users = User::all();
        $packages = Package::all();
        return view('admin.subscriptions.edit', compact('subscription', 'users', 'packages'));
    }

    /**
     * Update the specified subscription in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'package_id' => 'required|exists:packages,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'number_month' => 'required|integer|min:1',
        ]);

        $subscription = UserSubscription::findOrFail($id);
        $subscription->update($request->all());

        return redirect()->route('admin.subscriptions.index')
            ->with('success', 'Subscription updated successfully.');
    }

    /**
     * Remove the specified subscription from storage.
     */
    public function destroy($id)
    {
        $subscription = UserSubscription::findOrFail($id);
        $subscription->delete();

        return response()->json(['success' => true]);
    }
}
