<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminPaymentController extends Controller
{
    // Show all payments
    public function index(Request $request)
    {
        $query = Payment::with('subscription', 'subscription.user', 'subscription.package');

        if ($request->has('searchUserID') && $request->searchUserID != '') {
            $query->whereHas('subscription.user', function ($q) use ($request) {
                $q->where('id', $request->searchUserID);
            });
        }

        if ($request->has('searchUserName') && $request->searchUserName != '') {
            $query->whereHas('subscription.user', function ($q) use ($request) {
                $q->where('username', 'like', '%' . $request->searchUserName . '%');
            });
        }

        if ($request->has('searchPackage') && $request->searchPackage != '') {
            $query->whereHas('subscription.package', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->searchPackage . '%');
            });
        }

        if ($request->has('searchPaymentStatus') && $request->searchPaymentStatus != '') {
            $query->where('payment_status', $request->searchPaymentStatus);
        }

        $payments = $query->paginate(15);
        // Return the view with the payments data
        return view('admin.pages.user.payment', compact('payments'));
    }
}
